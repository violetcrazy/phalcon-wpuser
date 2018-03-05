<?php 
chdir(dirname(__DIR__));

define('ROOT', __DIR__);

if (isset($_SERVER['ENV'])) {
    $applicationEnv = ($_SERVER['ENV'] ? $_SERVER['ENV'] : 'prod');
} else {
    $applicationEnv = (getenv('ENV') ? getenv('ENV') : 'prod');
}
define('ENV', $applicationEnv);
 
// 

class Bootstrap
{
	private $di;
	private $config;
	private $loader;
	
	function __construct()
	{
		$this->di = new \Phalcon\DI\FactoryDefault();	
	}

	public function initConfig()
	{
        $parameter = array();
	    require_once ROOT . '/app/config/parameter.php';
		$this->config = new \Phalcon\Config($parameter);
		$this->di->setShared('config', $this->config);
	}

	private function initDB()
	{
		 // Database
        $db = new \Phalcon\Db\Adapter\Pdo\Mysql([
            "host"     => $this->config->db->host,
            "username" => $this->config->db->username,
            "password" => $this->config->db->password,
            "dbname"   => $this->config->db->dbname,
            "charset"  => $this->config->db->charset,
        ]);
        $this->di->set('db', $db);
	}

	private function initView()
    {
        
        $config = $this->config;

        $this->di->setShared('volt', function($view, $di) use ($config) {
            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

            $volt->setOptions(array(
                'compiledPath'      => ROOT . '/cache/volt/',
                'compiledSeparator' => $config->volt->compiled_separator,
                'compileAlways'     => (bool)$config->volt->debug,
                'stat'              => (bool)$config->volt->stat
            ));

            $compiler = $volt->getCompiler();

            $compiler->addFunction('in_array', 'in_array');
            $compiler->addFunction('intval', 'intval');
            $compiler->addFunction('http_build_query', 'http_build_query');
            $compiler->addFunction('strtotime', 'strtotime');
            $compiler->addFunction('date', 'date');
            $compiler->addFunction('json_decode', 'json_decode');
            $compiler->addFunction('explode', 'explode');
            $compiler->addFunction('implode', 'implode');
            $compiler->addFunction('substr', 'substr');
            $compiler->addFunction('mb_strtolower', 'mb_strtolower');

            return $volt;
        });

        $this->di->setShared('view', function() {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir(ROOT . '/views/');
            $view->registerEngines(array('.volt' => 'volt'));

            $view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

            return $view;
        });
    }

    private function initUrl()
    {
    	// URL
        $url = new \Phalcon\Mvc\Url();
        $url->setBasePath($this->config->base_path);
        $url->setBaseUri($this->config->base_uri);
        $this->di->set('url', $url);
    }

    private function iniSession()
    {
        // Session
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        $this->di->set('session', $session);
    }
    private function iniFlashSession()
    {
    	// Flash helper
        $flash = new \Phalcon\Flash\Session([
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning',
        ]);
        $flash->setAutoescape(false);
        $this->di->setShared('flashSession', $flash);
    }

    private function initEventManager($di)
    {
        $eventsManager = new \Phalcon\Events\Manager();
        $dispatcher = new \Phalcon\Mvc\Dispatcher();

        $eventsManager->attach("dispatch:beforeDispatchLoop", function ($event, $dispatcher) use ($di) {

        });

        $eventsManager->attach("dispatch:afterDispatchLoop", function ($event, $dispatcher) use ($di){

        });

        $eventsManager->attach('dispatch:beforeException', function($event, $dispatcher, $exception) use ($di){
            $type = $event->getType();
            $response = $di['response'];

            if ($exception->getCode() == \Phalcon\Mvc\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND || $exception->getCode() == \Phalcon\Mvc\Dispatcher::EXCEPTION_ACTION_NOT_FOUND) {
                $response->setStatusCode(404, 'Not Found');
                $dispatcher->forward(array(
                    'module' => 'core',
                    'controller' => 'error',
                    'action' => 'error404',
                ));
                return false;
            } else {
                $response->setStatusCode(503, 'Service Unavailable');
                $di['view']->e = $exception->getMessage();
                $dispatcher->forward(array(
                    'module' => 'core',
                    'controller' => 'error',
                    'action' => 'error'
                ));
                return false;
            }
        });

        // Profiler
        $registry = $di->get('registry');
        $profiler = new \Phalcon\Db\Profiler();
        $di->set('profiler', $profiler);

        $eventsManager->attach('db', function ($event, $db) use ($profiler) {
            if ($event->getType() == 'beforeQuery') {
                $profiler->startProfile($db->getSQLStatement());
            }
            if ($event->getType() == 'afterQuery') {
                $profiler->stopProfile();
            }
        });

        $db = $di->get('db');
        $db->setEventsManager($eventsManager);
        $di->set('db', $db);

        $dispatcher->setEventsManager($eventsManager);
        $di->set('dispatcher', $dispatcher);

    }

    private function dispatch()
    {
        $router = $this->di['router'];

        $router->handle();

        $view = $this->di['view'];
        $dispatcher = $this->di['dispatcher'];
        $response = $this->di['response'];

        $dispatcher->setModuleName($router->getModuleName());
        $dispatcher->setControllerName($router->getControllerName());
        $dispatcher->setActionName($router->getActionName());
        $dispatcher->setParams($router->getParams());

        $moduleName = \Plugins\ModuleName::camelize($router->getModuleName());

        $ModuleClassName = $moduleName . '\Module';
        if (class_exists($ModuleClassName)) {
            $module = new $ModuleClassName;
            $module->registerAutoloaders();
            $module->registerServices($this->di);
        }

        $view->start();

        $registry = $this->di['registry'];
        if (ENV == 'dev') {
            $debug = new \Phalcon\Debug();
            $debug->listen();

            $dispatcher->dispatch();
        } else {
            try {
                $dispatcher->dispatch();
            } catch (\Phalcon\Exception $e) {
                // Errors catching
                $view->e = $e;

                if ($e instanceof \Phalcon\Mvc\Dispatcher\Exception) {
                    $response->setStatusCode(404, 'Not Found');
                    $view->partial('error/error404');
                } else {
                    $response->setStatusCode(503, 'Service Unavailable');
                    $view->partial('error/error503');
                }

                return $response;
            }
        }

        $view->render(
            $dispatcher->getControllerName(),
            $dispatcher->getActionName(),
            $dispatcher->getParams()
        );

        $view->finish();

        // AJAX
        $request = $this->di['request'];
        $_ajax = $request->getQuery('_ajax');
        if ($_ajax) {
            $contents = $view->getContent();

            $return = new \stdClass();
            $return->html = $contents;
            $return->success = true;

            if ($view->bodyClass) {
                $return->bodyClass = $view->bodyClass;
            }

            $headers = $response->getHeaders()->toArray();
            if (isset($headers[404]) || isset($headers[503])) {
                $return->success = false;
            }
            $response->setContentType('application/json', 'UTF-8');
            $response->setContent(json_encode($return));
        } else {
            $response->setContent($view->getContent());
        }

        return $response;
    }

    private function initRouting($application)
    {
        $router = new  \Phalcon\Mvc\Router(false);
        $router->setDi($this->di);
        foreach ($application->getModules() as $module) {
            $routesClassName = str_replace('Module', 'Routes', $module['className']);
            if (class_exists($routesClassName)) {
                $routesClass = new $routesClassName();
                $router = $routesClass->init($router);
            }
        }

        $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

        $this->di->set('router', $router);
    }


	public function run(){
		$this->initConfig();

        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces($this->config->loader->namespaces->toArray());
        $loader->registerDirs(array(
            ROOT . '/plugins/',
            ROOT . '/app/modules/',
        ));
        // $this->loader->registerFiles([ADMINISTRATOR_PATH . '/../vendor/autoload.php']);
        $loader->register();

		$registry = new \Phalcon\Registry();
        $this->di->set('registry', $registry);

        $this->iniFlashSession();
        $this->initDB();
        $this->initUrl();
        $this->iniSession();
        $this->initView();

		// Application
        $application = new \Phalcon\Mvc\Application();
        $application->registerModules($this->config->modules->toArray());


        $this->initEventManager($this->di);
		$this->initRouting($application);

        $application->setDI($this->di);

        $response = $this->dispatch();
        $response->send();
	}
}



//
$bootstrap = new Bootstrap();
$bootstrap->run();
