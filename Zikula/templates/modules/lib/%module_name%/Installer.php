<?php
%header%

/**
 * Installer.
 */
class %module_name%_Installer extends Zikula_AbstractInstaller{

	/**
	 * Install the %module_name% module.
	 * This function is only ever called once during the lifetime of a particular
	 * module instance.
	 * @return boolean True on success, false otherwise.
	 */
	public function install(){
		// create the table
		/*
		try {
				DoctrineHelper::createSchema($this->entityManager, array('%module_name%_Entity_User',
																																 '%module_name%_Entity_UserCategory',
																																 '%module_name%_Entity_UserAttribute',
																																 '%module_name%_Entity_UserMetadata'));
		} catch (Exception $e) {
				return false;
		}
		*/

    //-- create tables
    $laMyTables = array();
		$dbtables = DBUtil::getTables();
    foreach( $dbtables as $lsTableName => $laTable ){
    	$liPos = strpos( $lsTableName, '%module_id%_');
    	if (!( $liPos === false)){
      	if ( strpos( $lsTableName, '_column') === false){
        	// create table
					if (!DBUtil::createTable( $lsTableName)) {
						return false;
					}
        }
      }
  	}


		$this->setVar('%module_id%_install', 1);

		//$this->defaultcategories();
		//$this->defaultdata();


		// Initialisation successful
		return true;
	}

	/**
	 * Upgrade the module from an old version.
	 * This function can be called multiple times.
	 * @param integer $oldversion Version to upgrade from.
	 * @return boolean True on success, false otherwise.
	 */
	public function upgrade($oldversion){
		switch ($oldversion)
		{
				case 0.5:
						// do something
				case 1.0:
						// do something
						// DoctrineHelper::createSchema($this->entityManager, array('%module_name%_Entity_User'));
						// to create any new tables
		}

		// Update successful
		return true;
	}

	/**
	 * Uninstall the module.
	 * This function is only ever called once during the lifetime of a particular
	 * module instance.
	 * @return bool True on success, false otherwise.
	 */
	public function uninstall()	{
		// drop table
		/*
		DoctrineHelper::dropSchema($this->entityManager, array('%module_name%_Entity_User',
																													 '%module_name%_Entity_UserCategory',
																													 '%module_name%_Entity_UserAttribute',
																													 '%module_name%_Entity_UserMetadata'));
		*/

    //-- create tables
    $laMyTables = array();
		$dbtables = DBUtil::getTables();
    foreach( $dbtables as $lsTableName => $laTable ){
    	$liPos = strpos( $lsTableName, '%module_id%_');
    	if (!( $liPos === false)){
      	if ( strpos( $lsTableName, '_column') === false){
        	// create table
					if (!DBUtil::dropTable( $lsTableName)) {
						return false;
					}
        }
      }
  	}

		// remove all module vars
		$this->delVars();

		// delete categories
		//CategoryRegistryUtil::deleteEntry('%module_name%');
		//CategoryUtil::deleteCategoriesByPath('/__SYSTEM__/Modules/%module_name%', 'path');

		// Deletion successful
		return true;
	}


	/**
	 * Provide default categories.
	 *
	 * @return void
	 */
	protected function defaultcategories(){
		if (!$cat = CategoryUtil::createCategory('/__SYSTEM__/Modules', '%module_name%', null, $this->__('%module_name%'), $this->__('%module_name% categories'))) {
				return false;
		}

		$rootcat = CategoryUtil::getCategoryByPath('/__SYSTEM__/Modules/%module_name%');
		CategoryRegistryUtil::insertEntry('%module_name%', 'User', 'Main', $rootcat['id']);

		CategoryUtil::createCategory('/__SYSTEM__/Modules/%module_name%', 'category1', null, $this->__('Category 1'), $this->__('Category 1'));
	}


	/**
	 * Provide default data.
	 *
	 * @return void
	 */
	protected function defaultdata()	{
		//$user = new %module_name%_Entity_User();
		//$user->setUser('namauser', 'passwordnya');
		//$this->entityManager->persist($user);
		//$this->entityManager->flush();

		$now = DateUtil::getDatetime();
		$uname = UserUtil::getVar('uname');
		$uid = UserUtil::getVar('uid');


	}
}

