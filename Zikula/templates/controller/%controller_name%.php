<?php
/**
 * Project Name: %project.name%
 * File: %controller_name%.php
 *
 * Generated by AksiIDE - Light IDE for PHP
 * @url http://www.aksiide.com
 *
 * @author     ______________________
 * @copyright
 * @Generated date %date%
 * @package   %project_name%
 * @subpackage
 * @generator  AksiIDE, http://www.aksiide.com
 *
 **/



//require_once DataUtil::formatForOS( "modules/%module_name%/config.app.php");
//include_once DataUtil::formatForOS( 'modules/%module_name%/lib/%module_name%/vendor/lib.php');
//include_once("system/Theme/lib/vendor/Mobile_Detect.php");

/**
 * This is the User controller class providing navigation and interaction functionality.
 */
class %module_name%_Controller_%controller_name% extends Zikula_AbstractController {
	//private $bExternalDB = false;

	/*
	function __construct($objectId){
        parent::__construct($objectId);
	}
	*/

	// bypass illegal parameter to 'main'
	function __call($method, $args)
    {
		$lsMethod = __METHOD__;
		//$lsFungsi = __FUNCTION__;
		return $this->main( $args);
	}

	/**
	 * This method is the default function.
	 * Called whenever the module's Admin area is called without defining arguments.
	 * @param array $args Array.
	 * @return string|boolean Output.
	 */
	public function main( $args)
    {
		global $Aksi;
		return $this->lists( $args);

		$now = DateUtil::getDatetime();
		$lsUserName = UserUtil::getVar( 'uname');
		$liUID = UserUtil::getVar( 'uid');

		$lsLanguage = ZLanguage::getLanguageCode();
		$dom = ZLanguage::getModuleDomain('%module_name%');
		$lsBahasa = __('bahasa', $dom);
		$lbAdmin = SecurityUtil::checkPermission( '%module_name%::', '::', ACCESS_ADMIN);

		// example: get parsing variable
		$psVariabel = FormUtil::getPassedValue('variablename', '', 'GETPOST', FILTER_SANITIZE_STRING);

		// your code

		$this->view->assign( 'bAdmin', $lbAdmin);
		$this->view->assign( 'date', $now);
		$this->view->assign( 'uname', $lsUserName);
		$this->view->assign( 'uid', $liUID);
		return $this->view->fetch( "user/main.tpl");
	}

     /**
      * function edit description
      * @params type $args description
      * @return type  description
      **/
	public function edit( $args)
    {
		global $Aksi;
		if (!SecurityUtil::checkPermission( '%module_name%::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError(ModUtil::url( '%module_name%', 'user', 'main'));
		}
		$psCat = FormUtil::getPassedValue('cat', '', 'GETPOST', FILTER_SANITIZE_STRING);

		// your code

		$lsURL = System::getBaseURL() . "%module_name%/edit/type/%controller_name_lowercase%/cat/$psCat";


		$form = FormUtil::newForm( '%module_name%', $this);
		$form->assign( 'sURL', $lsURL);
		$form->assign( 'sCategory', $psCat);
		return $form->execute( '%controller_name_lowercase%/edit.tpl', new %module_name%_Handler_Edit());
	}


     /**
      * function view description
      * @params type $args description
      * @return type  description
      **/
	public function view( $args)
    {
		global $Aksi;
		if (!SecurityUtil::checkPermission( '%module_name%::', '::', ACCESS_READ)) {
			return LogUtil::registerPermissionError(ModUtil::url( '%module_name%', 'user', 'main'));
		}

		$now = DateUtil::getDatetime();
		$psUserName = UserUtil::getVar( 'uname');
		$liUID = UserUtil::getVar( 'uid');

		$piID = FormUtil::getPassedValue( 'id', '', 'GETPOST', FILTER_SANITIZE_STRING);

		// your code


		$this->view->assign( 'iID', $piID);
		$this->view->assign( 'date', $now);
		$this->view->assign( 'uname', $psUserName);
		$this->view->assign( 'uid', $liUID);
		return $this->view->fetch( "%controller_name_lowercase%/view.tpl");
	}


     /**
      * function lists description
      * @params type $args description
      * @return type  description
      **/
	public function lists( $args) {
		global $Aksi;
		if (!SecurityUtil::checkPermission( '%module_name%::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError(ModUtil::url( '%module_name%', 'user', 'main'));
		}
		$now = DateUtil::getDatetime();
		$lsUserName = UserUtil::getVar( 'uname');
		$liUID = UserUtil::getVar( 'uid');

		$piID = FormUtil::getPassedValue( 'id', '', 'GETPOST', FILTER_SANITIZE_STRING);

		// your code


		$this->view->assign( 'date', $now);
		$this->view->assign( 'uname', $lsUserName);
		$this->view->assign( 'uid', $liUID);
		return $this->view->fetch( "%controller_name_lowercase%/lists.tpl");
	}


}
