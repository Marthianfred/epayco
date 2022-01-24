<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Clientes extends \App\Entities\Clientes implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'documento', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'nombres', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'email', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'celular', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'billeteras'];
        }

        return ['__isInitialized__', 'id', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'documento', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'nombres', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'email', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'celular', '' . "\0" . 'App\\Entities\\Clientes' . "\0" . 'billeteras'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Clientes $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
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
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getDocumento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDocumento', []);

        return parent::getDocumento();
    }

    /**
     * {@inheritDoc}
     */
    public function setDocumento($documento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDocumento', [$documento]);

        return parent::setDocumento($documento);
    }

    /**
     * {@inheritDoc}
     */
    public function getNombres()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombres', []);

        return parent::getNombres();
    }

    /**
     * {@inheritDoc}
     */
    public function setNombres($nombres)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNombres', [$nombres]);

        return parent::setNombres($nombres);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getCelular()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCelular', []);

        return parent::getCelular();
    }

    /**
     * {@inheritDoc}
     */
    public function setCelular($celular)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCelular', [$celular]);

        return parent::setCelular($celular);
    }

    /**
     * {@inheritDoc}
     */
    public function getBilleteras()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBilleteras', []);

        return parent::getBilleteras();
    }

    /**
     * {@inheritDoc}
     */
    public function AgragarBilletera(\App\Entities\Billeteras $billetera)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'AgragarBilletera', [$billetera]);

        return parent::AgragarBilletera($billetera);
    }

    /**
     * {@inheritDoc}
     */
    public function setBilleteras(\App\Entities\Billeteras $b)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBilleteras', [$b]);

        return parent::setBilleteras($b);
    }

}
