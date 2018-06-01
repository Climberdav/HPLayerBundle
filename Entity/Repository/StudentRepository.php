<?php

namespace Climberdav\HPLayerBundle\Entity\Repository;

use Climberdav\HPLayerBundle\Entity\Student;

/**
 * Class StudentRepository
 * Abstraction of getters/setters' ServiceWeb "Étudiants"
 * See @link(http://www.index-education.com/fr/ServiceWeb-Hyperplanning-Etudiants.php)
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Entity\Repository
 * @codeCoverageIgnore
 */
class StudentRepository extends Student
{
    /**
     * @param $key
     * @return Student $this
     */
    public function find($key)
    {
        $this->setKey($key);
        $this->setName($this->wsdlClient->PrenomEtudiant($key));
        $this->setLastname($this->wsdlClient->NomEtudiant($key));
        $this->setCas($this->wsdlClient->IdentifiantCASEtudiant($key));
        $this->setBirthdate($this->wsdlClient->DateDeNaissanceEtudiant($key));
        $this->setMail($this->wsdlClient->EMailEtudiant($key));
        $this->setNumeroDOrdre($this->wsdlClient->NumeroDOrdreEtudiant($key));
        return $this;
    }

    /**
     * @return array of Student
     */
    function findAll(){
        $keys = $this->wsdlClient->TousLesEtudiants();
        $name = $this->wsdlClient->PrenomsTableauDEtudiants($keys);
        $lastName = $this->wsdlClient->NomsTableauDEtudiants($keys);
        $CAS = $this->wsdlClient->IdentifiantsTableauDEtudiants($keys);
        $birth = $this->wsdlClient->DatesDeNaissancesTableauDEtudiants($keys);
        $mail = $this->wsdlClient->EMailsTableauDEtudiants($keys);
        $result = array_combine($keys, array_map(null,
                $keys,
                $name,
                $lastName,
                $CAS,
                $birth,
                $mail
            )
        );
        $return = array();
        foreach ($result as $key => $r){
            $a = new Student();
            $a->setKey($r[0]);
            $a->setName($r[1]);
            $a->setLastname($r[2]);
            $a->setCas($r[3]);
            $a->setBirthdate($r[4]);
            $a->setMail($r[5]);
            $return[] = $a;
            unset($a);
        }
        return $return;
    }
}