<?php

namespace App\Core;

class FormValidator
{

    public static function check($form, $data)
    {
        $errors = [];


        if (count($data) == count($form["inputs"])) {
            echo "<pre>";
            var_dump($form);
            foreach ($form["inputs"] as $name => $configInput) {

                if (!empty($configInput["minLength"]) &&
                    is_numeric($configInput["minLength"]) &&
                    strlen($data[$name]) < $configInput["minLength"]
                ) {
                    $errors[] = $configInput["error"];
                } elseif (!empty($configInput["maxLength"]) &&
                    is_numeric($configInput["maxLength"]) &&
                    strlen($data[$name]) > $configInput["maxLength"]) {
                    $errors[] = $configInput["error"];
                }
                if (!empty($configInput["required"]) && $configInput["required"] == true && empty($data[$name])) {
                    $errors[] = $name . " est obligatoire";
                }
                if ($name == "email" && !filter_var($data[$name], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "email non valide";
                }
                if ($name == "pwd" && !empty($data[$name]) && !empty($data["pwdConfirm"]) && $data[$name] != $data["pwdConfirm"]) {
                    $errors[] = "Mdp différent";
                }
                if (!empty($configInput["maj"]) && $configInput["maj"] == true) {
                    if (!preg_match("~[A-Z]~", $data[$name]) || !preg_match("~[a-z]~", $data[$name])) {
                        $errors[] = "Mdp doit contenir une minuscule et une majuscule";
                    }
                }
                if (!empty($configInput["num_verif"]) && $configInput["num_verif"] == true) {
                    if (!preg_match("~[0-9]~", $data[$name])) {
                        $errors[] = "Mdp doit contenir un chiffre";
                    }
                }
            }
        } else {
            $errors[] = "Tentative de Hack";
        }
        return $errors;
    }


}
