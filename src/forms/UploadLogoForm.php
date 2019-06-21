<?php

/**
 * This file is part of the DocPHT project.
 * 
 * @author Valentino Pesce
 * @copyright (c) Valentino Pesce <valentino@iltuobrand.it>
 * @copyright (c) Craig Crosby <creecros@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DocPHT\Form;

use Nette\Forms\Form;
use Nette\Utils\Html;
use DocPHT\Core\Translator\T;

class UploadLogoForm extends MakeupForm
{

    public function logo()
    {
        $form = new Form;
        $form->onRender[] = [$this, 'bootstrap4'];

        $form->addGroup(T::trans('Add logo'));
        
        $form->addUpload('file', T::trans('File must be PNG'))
            ->setRequired(true)
            ->addRule(Form::MIME_TYPE, T::trans('File must be PNG'), ['image/png'])
        	->addRule(Form::MAX_FILE_SIZE, T::trans('Maximum file size is 500 kb'), 500 * 1024 /* size in Bytes */);
        
        $form->addSubmit('submit', T::trans('Add'));

        if ($form->isSuccess()) {
            $values = $form->getValues();
            
        	if (isset($values['file'])) {
        	    
                $file = $values['file'];
                
        	    if(isset($file)) {
                    $this->doc->uploadLogoDocPHT($file);
                    header('Location:'.BASE_URL.'admin');
        			exit;
        	    } else {
    				$this->msg->error(T::trans('Sorry something didn\'t work!'),BASE_URL.'admin');
        	    }
        	}
        }
        
        return $form;
    }
    
    public function favicon()
    {
        $form = new Form;
        $form->onRender[] = [$this, 'bootstrap4'];

        $form->addGroup(T::trans('Add logo'));
        
        $form->addUpload('file', T::trans('File must be PNG'))
            ->setRequired(true)
            ->addRule(Form::MIME_TYPE, T::trans('File must be PNG'), ['image/png'])
        	->addRule(Form::MAX_FILE_SIZE, T::trans('Maximum file size is 500 kb'), 500 * 1024 /* size in Bytes */);
        
        $form->addSubmit('submit', T::trans('Add'));

        if ($form->isSuccess()) {
            $values = $form->getValues();
            
        	if (isset($values['file'])) {
        	    
                $file = $values['file'];
                
        	    if(isset($file)) {
                    $this->doc->uploadFavDocPHT($file);
                    header('Location:'.BASE_URL.'admin');
        			exit;
        	    } else {
    				$this->msg->error(T::trans('Sorry something didn\'t work!'),BASE_URL.'admin');
        	    }
        	}
        }
        
        return $form;
    }

}
