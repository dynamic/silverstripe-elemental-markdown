<?php

namespace Dynamic\Elements\Markdown\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\FieldType\DBField;
use UndefinedOffset\Markdown\Forms\MarkdownEditor;
use UndefinedOffset\Markdown\Model\FieldTypes\DBMarkdown;

/**
 * Class ElementMarkdown
 * @package Dynamic\Elements\Markdown\Element
 *
 * @property DBMarkdown Content
 */
class ElementMarkdown extends BaseElement
{
    /**
     * @var string
     */
    private static $icon = 'fab fa-markdown';

    /**
     * @var string
     */
    private static $singular_name = 'Markdown Element';

    /**
     * @var string
     */
    private static $plural_name = 'Markdown Elements';

    /**
     * @var string
     */
    private static $table_name = 'ElementMarkdown';

    /**
     * @var array
     */
    private static $db = [
        'Content' => 'Markdown',
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldToTab(
                'Root.Main',
                MarkdownEditor::create('Content')
                    ->setTitle('Markdown')
            );
        });

        return parent::getCMSFields();
    }

    /**
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function getSummary()
    {
        return DBField::create_field('HTMLText', $this->Content)->Summary(20);
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();

        return $blockSchema;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Markdown');
    }
}
