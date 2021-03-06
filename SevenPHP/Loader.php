<?php
	//https://www.cnblogs.com/woider/p/6443854.html
	//https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
	namespace seven;
	defined(DS) && define('DS',DIRECTORY_SEPARATOR);
	if(defined(APP_PATH)) {
		throw new \Exception("App Dir Not Defined");
	}
	class Loader {

		public static function autoload($class) {  
			$file = self::findFile($class); 
			if(!$file) {
				return false;
			} 
                        $t = __include_file($file); 
                        
			return true;
		}
		
		
		// 自动载入文件
		public static function register($autoload = '') {
			
			// 注册系统自动加载
	        spl_autoload_register($autoload ?$autoload: 'seven\Loader::autoload', true, true);

		}


		private static function findFile($class) {

			$file =  APP_PATH.'\\'.$class.EXT;
			
                        return strtr($file, '\\', DIRECTORY_SEPARATOR);

		}



	}


/**
 * 作用范围隔离
 *
 * @param $file
 * @return mixed
 */
function __include_file($file) {
    if(is_file($file)) {
        return include $file;
    }
    return false;
}

function __require_file($file) {
    if(is_file($file)) {
        return require $file;
    }
    return false;
}

?>