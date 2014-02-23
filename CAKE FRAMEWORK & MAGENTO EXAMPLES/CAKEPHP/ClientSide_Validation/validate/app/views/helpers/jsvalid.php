<?php  
class JsvalidHelper extends Helper 
{ 
    var $helpers = array('Html','Javascript','Form','Ajax','Jsvalid'); 
    var $validate; 
    var $model; 
    var $changeClass = true; 
    var $errorClass = 'errors'; 
    var $ulUpdate; 
    var $blurCheck = false; 
    var $alertFlag = true; 
    var $feedback; 
    var $unique = false; 
    var $script="<script type='text/javascript'> 
function errorClass(id,newClass){ 
    var elem_ar = document.getElementsByTagName('label'); 
    var classOld = ''; 
    var labelFor = ''; 
    var elem; 
    for(x in elem_ar){ 
        labelFor = elem_ar[x].htmlFor+''; 
        if(labelFor.indexOf(id) != -1){ 
            elem = elem_ar[x]; 
        } 
    } 
    classOld = elem.className+''; 
    if(classOld.indexOf(newClass) == -1){ 
        elem.className = newClass+' '+classOld; 
    } 
} 
function validClass(id,newClass){ 
    var elem_ar = document.getElementsByTagName('label'); 
    var classOld = ''; 
    var labelFor = ''; 
    var elem = ''; 
    for(x in elem_ar){ 
        labelFor = elem_ar[x].htmlFor+''; 
        if(labelFor.indexOf(id) != -1){ 
            elem = elem_ar[x]; 
        } 
    } 
    if(elem!=''){ 
        classOld = elem.className+''; 
        if(classOld.indexOf(newClass+' ') != -1){ 
            elem.className = classOld.replace(newClass+' ',''); 
        } else if (classOld.indexOf(newClass) != -1){ 
            elem.className = classOld.replace(newClass,''); 
        } 
    } 
} 
function jsvalidateForm(form){ 
    var valid = true; 
    var result = 'Please fix the following error(s):';"; 
    function feedbackfun($field){ 
        if(!empty($this->feedback)){ 
            return $this->feedback[$field]; 
        } else { 
            return $field.' is not valid'; 
        } 
    } 
    function setModel ($model,$validate = null){ 
        if($validate != null){ 
            $this->validate = $validate;     
        } else { 
            $this->validate = $this->view->controller->{$model}->validate; 
        } 
        $this->model = $model; 
        if(!empty($this->view->controller->{$model}->jsFeedback) && isset($this->view->controller->{$model}->jsFeedback)){ 
            $this->feedback = $this->view->controller->{$model}->jsFeedback; 
        } 
        return ($this->validate); 
    } 
    function input($fieldName,$label,$fieldAtt = null){ 
        $labelTag = $this->Form->labelTag($fieldName,$label); 
        $inputTag = $this->Html->input($fieldName,$fieldAtt); 
        return $this->output($labelTag.$inputTag); 
    } 
    function textarea($fieldName,$label, $fieldAtt = null){ 
        $labelTag = $this->Form->labelTag($fieldName,$label); 
        $textareaTag = $this->Html->textarea($fieldName,$fieldAtt); 
        return $this->output($labelTag.$textareaTag); 
    }      
    function password($fieldName,$label,$fieldAtt = null){ 
        $labelTag = $this->Form->labelTag($fieldName,$label); 
        $inputTag = $this->Html->password($fieldName,$fieldAtt); 
        return $this->output($labelTag.$inputTag); 
    } 
    function form($url = null, $name = null, $method = 'post'){ 
        $formTag = "<form action='".$this->Html->url($url)."' method='{$method}' onSubmit='jsvalidateForm(this); return false;'"; 
        if ($name != null){ 
            $formTag .=" name='{$name}'>"; 
        } else { 
            $formTag .='>'; 
        } 
        return $formTag; 
    } 
    function required($fields = array()){ 
        if(empty($fields)){ 
            foreach($this->validate as $key => $value): 
                $this->script .=' 
    if(form.'.Inflector::camelize($this->model." ".$key).'){ 
        str = form.'.Inflector::camelize($this->model." ".$key).'.value; 
        regexp = '.$value.'; 
        if(!str.match(regexp)){ 
            valid = false; 
            result +="\n'.$this->feedbackfun($key).'";'; 
                if($this->changeClass){ 
                    $this->script .=' 
            errorClass("'.Inflector::camelize($this->model." ".$key).'","'.$this->errorClass.'"); 
        } else { 
            validClass("'.Inflector::camelize($this->model." ".$key).'","'.$this->errorClass.'"); 
        }'; 
                } else { 
                    $this->script .=' 
        }'; 
                } 
                $this->script .=' 
    }'; 
            endforeach; 
        } else { 
            foreach($fields as $field => $feedback): 
                if(is_int($field)){ 
                    $field = $feedback; 
                    $feedback = false; 
                } 
                $fieldName_ar = explode("/",$field); 
                $fieldName = Inflector::camelize($fieldName_ar[0]." ".$fieldName_ar[1]); 
                $regExp = $this->validate[$fieldName_ar[1]]; 
                if($feedback == false){ 
                    $feedback = $this->feedbackfun($fieldName_ar[1]); 
                } 
                $this->script .=' 
    if(form.'.$fieldName.'){ 
        str = form.'.$fieldName.'.value; 
        regexp = '.$regExp.'; 
        if(!str.match(regexp)){ 
            valid = false; 
            result +="\n'.$feedback.'";'; 
        if($this->changeClass){ 
            $this->script .=' 
            errorClass("'.$fieldName.'","'.$this->errorClass.'"); 
        } else { 
            validClass("'.$fieldName.'","'.$this->errorClass.'"); 
        }'; 
        } else { 
            $this->script .=' 
        }'; 
        } 
        $this->script .=' 
    }'; 
            endforeach; 
        } 
    } 
    function confirm($field,$confirms = array()){ 
        $fieldName_ar = explode("/",$field); 
        $fieldName = Inflector::camelize($fieldName_ar[0]." ".$fieldName_ar[1]); 
        foreach($confirms as $key => $value): 
            $confirm_ar = explode("/",$key); 
            $confirmName = Inflector::camelize($confirm_ar[0]." ".$confirm_ar[1]); 
            $this->script .= ' 
    if(form.'.$fieldName.'.value != form.'.$confirmName.'.value){ 
        valid = false; 
        result +="\n'.$value.'"; 
        errorClass("'.$confirmName.'","'.$this->errorClass.'"); 
    } else { 
        validClass("'.$confirmName.'","'.$this->errorClass.'"); 
    } 
    '; 
        endforeach; 
    } 
    function server($field, $label, $url, $divClass = 'jsunique',$fieldAtt = null){ 
        $fieldName_ar = explode("/",$field); 
        $fieldName = Inflector::camelize($fieldName_ar[0]." ".$fieldName_ar[1]); 
        $labelTag = $this->Form->labelTag($field,$label); 
        $inputTag = $this->Html->input($field,$fieldAtt); 
        $button = "<input type='button' value='Check' onclick='unique(\"".$fieldName."\")'/>"; 
        $divTag = "<div id='jsu".$fieldName."' class='".$divClass."'></div>"; 
        $script = "<script type='text/javascript'> 
function unique (id){ 
    elem = document.getElementById(id); 
    new Ajax.Updater('jsu".$fieldName."', '".$url."', {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(elem)});     
} 
</script>"; 
        return $script.$labelTag.$inputTag.$button.$divTag; 
    } 
    function returnScript(){ 
        $this->script .= ' 
    if(valid){ 
        form.submit(); 
    } else { 
        alert(result); 
    }'; 
        $this->script.=" 
}"; 
         
        $this->script .=" 
</script> 
"; 
        return $this->script; 
    } 
} 
?>