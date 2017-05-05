<?php

namespace ClimberdavHPLayerBundle\Traits;


use ClimberdavHPLayerBundle\Entity\Student;

trait StudentTrait
{
    /**
     * @return array of Student
     */
    function getStudents(){
        $keys = $this->wsdlClient->TousLesEtudiants();
        $name = $this->wsdlClient->PrenomsTableauDEtudiants($keys);
        $lastName = $this->wsdlClient->NomsTableauDEtudiants($keys);
        $CAS = $this->wsdlClient->IdentifiantsTableauDEtudiants($keys);
        $birth = $this->wsdlClient->DatesDeNaissancesTableauDEtudiants($keys);
        $mail = $this->wsdlClient->EMailsTableauDEtudiants($keys);
        $result = array_combine($keys, array_map(null,
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
            $a->setName($r[0]);
            $a->setLastName($r[1]);
            $a->setCAS($r[2]);
            $a->setBirth($r[3]);
            $a->setMail($r[4]);
            $a->setKeyHP($key);

            $return[] = $a;
            unset($a);
        }

        return $return;
    }

    /**
     * @param null $key
     * @return Student
     */
    function getStudent($key = null){
        // 4881
        $student = new Student();
        $student->setName($this->wsdlClient->PrenomEtudiant($key));
        $student->setLastName($this->wsdlClient->NomEtudiant($key));
        $student->setCAS($this->wsdlClient->IdentifiantEtudiant($key));
        $student->setBirth($this->wsdlClient->DateDeNaissanceEtudiant($key));
        $student->setMail($this->wsdlClient->EMailEtudiant($key));
        $student->setKeyHP($key);

        return $student;
    }

}