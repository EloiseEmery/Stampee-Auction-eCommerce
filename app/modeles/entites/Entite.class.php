<?php

/**
 * Classe Entité dont hérite toutes les classes des entités de la base de données
 *
 */
abstract class Entite {
	
	/**
	 * Constructeur de la classe
	 * @param array $proprietes, tableau associatif des propriétés 
	 *
	 */ 
	public function __construct($proprietes = []) {
		$t = array_keys($proprietes);

		foreach ($t as $nom_propriete) {
			$this->__set($nom_propriete, $proprietes[$nom_propriete]);
		} 
	}

	/**
	 * hydratation des propriétés de la classe sans passer par les setters ()
	 * quand les données sont sûres car elles proviennent de la base de données 
	 * @param array $proprietes, tableau associatif des propriétés 
	 */ 
	public function hydrater($proprietes = []) {
		foreach ($proprietes as $nom_propriete => $val_propriete) {
			$this->$nom_propriete = $val_propriete;
		}
		return $this;
	}

	/**
	 * Accesseur magique d'une propriété de l'objet
	 * @param string $prop, nom de la propriété
	 * @return property value
	 */     
		public function __get($prop) {
		return $this->$prop;
	}

	/**
	 * Mutateur magique qui exécute le mutateur de la propriété en paramètre 
	 * @param string $prop, nom de la propriété
	 * @param $val, contenu de la propriété à mettre à jour    
	 */   
	public function __set($prop, $val) {
		$setProperty = 'set'.ucfirst($prop);
		$this->$setProperty($val);
	}
}