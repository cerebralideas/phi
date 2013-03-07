<?php
class AccitemasyncController extends Zend_Controller_Action
{
    private $auth;
    private $storage;
    private $userId;
    private $accItemService;

    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->auth = Zend_Auth::getInstance();
        $this->storage = $this->auth->getStorage();
        $this->userId = $this->storage->read()->id;
        $this->accItemService = new Service_AccItem();
    }

    public function saveaccitemAction()
    {
        $value = Zend_Json_Decoder::decode(file_get_contents('php://input'));
        if ( $value )
            echo $this->accItemService->updateJson( $value );
        //Zend_Debug::dump( $value );
    }

    public function submitaccitemAction()
    {
        $value = Zend_Json_Decoder::decode(file_get_contents('php://input'));
        $this->accItemService->updateJson( $value );
    }

    public function newaccitemAction()
    {
        $value = Zend_Json_Decoder::decode(file_get_contents('php://input'));
        $this->accItemService->insertJson( $value );
    }

}