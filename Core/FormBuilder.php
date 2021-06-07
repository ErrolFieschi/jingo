<?php

namespace App\Core;

class FormBuilder
{

    public static function render($form)
    {

        $html = "<form 
				method='" . ($form["config"]["method"] ?? "GET") . "' 
				id='" . ($form["config"]["id"] ?? "") . "' 
				class='" . ($form["config"]["class"] ?? "") . "' 
				action='" . ($form["config"]["action"] ?? "") . "'>";


        foreach ($form["inputs"] as $name => $configInput) {

            $html .= "<div class='form_input_wrapper'>";

            //$html .= "<label for='" . ($configInput["id"] ?? "") . "'>" . ($configInput["label"] ?? "") . " </label>";


            if ($configInput["type"] == "select") {
                $html .= self::renderSelect($name, $configInput);
            } else if ($configInput["type"] == "checkbox" || $configInput["type"] == "radio") {
                $html .= self::renderCheckboxRadio($name, $configInput);
            } else if ($configInput["type"] == "textarea") {
                $html .= self::renderTextArea($name, $configInput);
            } else {
                $html .= self::renderInput($name, $configInput);
            }

            $html .= "</div>";

        }

        $html .= "<div class='flex justify-center'>
                    <button class='button-con' type='submit'> ". ($form["config"]["submit"] ?? "Valider") ." </button>
                  </div>";
                  
        $html .= "</form>";

        echo $html;
    }


    public static function renderInput($name, $configInput)
    {
        if($configInput["type"]) {
            $html = "<label>". ($configInput["label"] ?? "text")  ."</label>";
        }
        $html .= "<input 
						name='" . $name . "' 
						type='" . ($configInput["type"] ?? "text") . "'
						id='" . ($configInput["id"] ?? "") . "'
						class='" . ($configInput["class"] ?? "") . "'
						placeholder='" . ($configInput["placeholder"] ?? "") . "'
                        " . ($configInput["type"] === "date" && !empty($configInput["minDate"])  ? "min=".$configInput["minDate"] : "") . "
                        " . ($configInput["type"] === "date" && !empty($configInput["maxDate"])  ? "max=".$configInput["maxDate"] : "") . "
						" . (!empty($configInput["required"]) ? "required='required'" : "") . "
					>";
        return $html;
    }


    public static function renderSelect($name, $configInput)
    {
        $html = "<select name='" . $name . "' id='" . ($configInput["id"] ?? "") . "'
		                 id='" . ($configInput["id"] ?? "") . "'
						 class='" . ($configInput["class"] ?? "") .
            (!empty($configInput["required"]) ? "required='required'" : "") . "'>";

        foreach ($configInput["options"] as $key => $value) {
            $html .= "<option value='" . $key . "'>" . $value . "</option>";
        }
        $html .= "</select>";

        return $html;
    }

    public static function renderTextArea($name, $configInput)
    {
        return "<textarea 
						name='" . $name . "' 
						id='" . ($configInput["id"] ?? "") . "'
						placeholder='" . ($configInput["placeholder"] ?? "") . "'
						" . (!empty($configInput["required"]) ? "required='required'" : "") . "
					></textarea>";
    }


    public static function renderCheckboxRadio($name, $configInput)
    {
        $html = "";

        foreach ($configInput["options"] as $key => $value) {
            $html .= "<label class='form_check_label' for='". ($configInput["id"] ?? "") ."'> 
                        <input type='" . ($configInput["type"] ?? "") . "'
                                name='" . ($configInput["id"] ?? "") . "' 
                                id='" . $name . "' 
                                class='" . ($configInput["class"] ?? "") . "'
                                value='" . $value . "'>";
            $html .= $key ." </label>";
        }
        return $html;
    }



}
