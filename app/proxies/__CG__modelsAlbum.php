<?php

namespace DoctrineProxies\__CG__\models;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Album extends \models\Album implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array('title' => NULL, 'description' => NULL, 'view_status' => NULL, 'chg_date' => NULL);



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {
        unset($this->title, $this->description, $this->view_status, $this->chg_date);

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }

    /**
     * 
     * @param string $name
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', array($name));

            return $this->$name;
        }

        trigger_error(sprintf('Undefined property: %s::$%s', __CLASS__, $name), E_USER_NOTICE);
    }

    /**
     * 
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', array($name, $value));

            $this->$name = $value;

            return;
        }

        $this->$name = $value;
    }

    /**
     * 
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__isset', array($name));

            return isset($this->$name);
        }

        return false;
    }

    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'title', 'description', 'view_status', 'pub_date', 'chg_date', 'villa', 'page', 'images');
        }

        return array('__isInitialized__', 'id', 'pub_date', 'villa', 'page', 'images');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Album $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

            unset($this->title, $this->description, $this->view_status, $this->chg_date);
        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', array($title));

        return parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', array());

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setViewStatus($viewStatus)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setViewStatus', array($viewStatus));

        return parent::setViewStatus($viewStatus);
    }

    /**
     * {@inheritDoc}
     */
    public function getViewStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getViewStatus', array());

        return parent::getViewStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setPubDate($pubDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPubDate', array($pubDate));

        return parent::setPubDate($pubDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getPubDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPubDate', array());

        return parent::getPubDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setChgDate($chgDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setChgDate', array($chgDate));

        return parent::setChgDate($chgDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getChgDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getChgDate', array());

        return parent::getChgDate();
    }

    /**
     * {@inheritDoc}
     */
    public function addImage(\models\Image $image)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addImage', array($image));

        return parent::addImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function removeImage(\models\Image $image)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeImage', array($image));

        return parent::removeImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function getImages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImages', array());

        return parent::getImages();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', array($description));

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', array());

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setPage(\models\Page $page = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPage', array($page));

        return parent::setPage($page);
    }

    /**
     * {@inheritDoc}
     */
    public function getPage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPage', array());

        return parent::getPage();
    }

    /**
     * {@inheritDoc}
     */
    public function addPage(\models\Page $page)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPage', array($page));

        return parent::addPage($page);
    }

    /**
     * {@inheritDoc}
     */
    public function removePage(\models\Page $page)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePage', array($page));

        return parent::removePage($page);
    }

    /**
     * {@inheritDoc}
     */
    public function addVilla(\models\Villa $villa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addVilla', array($villa));

        return parent::addVilla($villa);
    }

    /**
     * {@inheritDoc}
     */
    public function removeVilla(\models\Villa $villa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeVilla', array($villa));

        return parent::removeVilla($villa);
    }

    /**
     * {@inheritDoc}
     */
    public function getVilla()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVilla', array());

        return parent::getVilla();
    }

}
