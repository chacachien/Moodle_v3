<?php

class __Mustache_74c175530734e2ddd8b40afd4b33a225 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        if ($parent = $this->mustache->loadPartial('mod_forum/social_discussion_list')) {
            $context->pushBlockContext(array(
                'discussion_create_text' => array($this, 'block06f84145ff041fe5814a51b859674bd0'),
                'discussion_top_pagination' => array($this, 'blockD41d8cd98f00b204e9800998ecf8427e'),
                'discussion_bottom_pagination' => array($this, 'block0774b718c49ecac3eeb95a3128b0894a'),
            ));
            $buffer .= $parent->renderInternal($context, $indent);
            $context->popBlockContext();
        }

        return $buffer;
    }

    private function sectionEcfce418daf3acedbc7f31951ebf57d5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addanewtopic, forum';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addanewtopic, forum';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section581f7add52ff6906be44abade58583c3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'oldertopics, mod_forum';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'oldertopics, mod_forum';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section99de6bf2301715de05973760119603a7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <a href="{{{forum.urls.view}}}">{{#str}}oldertopics, mod_forum{{/str}}...</a>
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            <a href="';
                $value = $this->resolveValue($context->findDot('forum.urls.view'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '">';
                $value = $context->find('str');
                $buffer .= $this->section581f7add52ff6906be44abade58583c3($context, $indent, $value);
                $buffer .= '...</a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    public function block06f84145ff041fe5814a51b859674bd0($context)
    {
        $indent = $buffer = '';
        $buffer .= $indent . '        ';
        $value = $context->find('str');
        $buffer .= $this->sectionEcfce418daf3acedbc7f31951ebf57d5($context, $indent, $value);
        $buffer .= '
';
    
        return $buffer;
    }

    public function blockD41d8cd98f00b204e9800998ecf8427e($context)
    {
        $indent = $buffer = '';
    
        return $buffer;
    }

    public function block0774b718c49ecac3eeb95a3128b0894a($context)
    {
        $indent = $buffer = '';
        $value = $context->find('hasmore');
        $buffer .= $this->section99de6bf2301715de05973760119603a7($context, $indent, $value);
    
        return $buffer;
    }
}
