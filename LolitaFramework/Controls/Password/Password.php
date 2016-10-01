<?php
namespace datagenerator\LolitaFramework\Controls\Password;

use \datagenerator\LolitaFramework\Controls\Control;
use \datagenerator\LolitaFramework\Core\Arr;

class Password extends Control
{
    /**
     * Render control
     *
     * @author Guriev Eugen <gurievcreative@gmail.com>
     * @return string html code.
     */
    public function render()
    {
        $this->setAttributes(
            array_merge(
                $this->getAttributes(),
                array(
                    'name'                        => $this->getName(),
                    'value'                       => $this->getValue(),
                    'type'                        => 'password',
                    'data-customize-setting-link' => $this->getName(),
                )
            )
        );
        return parent::render();
    }
}
