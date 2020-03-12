<?php
	namespace Distribution\Entity;

	/**
	* 
	*/
	class Quote
	{
		private $id;
		private $id_user;
		private $creation_date;
		private $validated;
		private $com_admin;
		private $com_member;
		private $city_name;
		private $number_tract;

		public function __construct (array $data)
	    {
	      $this->hydrate($data);
	    }

		public function id() { return $this->id;}
		public function id_user() { return $this->id_user;}
		public function creation_date() { return $this->creation_date;}
		public function validated() { return $this->validated;}
		public function com_admin() { return $this->com_admin;}
		public function com_member() { return $this->com_member;}
		public function city_name() { return $this->city_name;}
		public function number_tract() { return $this->number_tract;}

		public function hydrate(array $data)
	    {
	      foreach ($data as $key => $value)
	      {
	        $method = 'set'.ucfirst($key);           
	        if (method_exists($this, $method))
	        {
	          $this->$method($value);
	        }
	      }
	    }

	    public function setId ($id)
	    {
	    	$id = (int) $id;
    		if ($id > 0)
   			{
      			$this->id = $id;
    		}  
	    } 

	    public function setId_user ($id_user)
	    {
	    	$id_user = (int) $id_user;
    		if ($id_user > 0)
   			{
      			$this->id_user = $id_user;
    		}  
	    } 

	    public function setCreation_date ($creation_date)
	    {
	    	if (is_string($creation_date))
	    	{
	    		$this->creation_date = $creation_date;
	    	}
	    } 

	    public function setValidated ($validated)
	    {
	    	$validated = (int) $validated;
    		if ($validated === 0 || $validated === 1)
   			{
      			$this->validated = $validated;
    		}  
	    } 

	    public function setCom_admin ($com_admin)
	    {
	    	if (is_string($com_admin))
	    	{
	    		$this->com_admin = $com_admin;
	    	}
	    } 

	    public function setCom_member ($com_member)
	    {
	    	if (is_string($com_member))
	    	{
	    		$this->com_member = $com_member;
	    	}
	    } 

	    public function setCity_name ($city_name)
	    {
	    	if (is_string($city_name))
	    	{
	    		$this->city_name = $city_name;
	    	}
	    } 

	    public function setNumber_tract ($number_tract)
	    {
	    	$number_tract = (int) $number_tract;
    		if ($number_tract > 0)
   			{
      			$this->number_tract = $number_tract;
    		} 
	    }  
	}