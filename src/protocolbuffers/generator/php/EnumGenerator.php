<?php
/*
 * This file is part of the protoc-gen-php package.
 *
 * (c) Shuhei Tanuma <shuhei.tanuma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace protocolbuffers\generator\php;

use google\protobuf\EnumValueDescriptorProto;
use protocolbuffers\GeneratorContext;
use protocolbuffers\io\Printer;

class EnumGenerator extends MessageGenerator
{
    public function __construct(GeneratorContext $context,
                                \google\protobuf\EnumDescriptorProto $descriptor,
                                &$file_list)
    {
        $this->descriptor = $descriptor;
        $this->context = $context;
        $this->file_list = &$file_list;

        if ($descriptor->file()->getOptions()->getExtension("php")->getMultipleFiles()) {
            $this->enclose_namespace_ = false;
        } else {
            $this->enclose_namespace_ = true;
        }
    }

    public function getEnumValueAsString(EnumValueDescriptorProto $value)
    {
        return $value->getName();
    }

    public function generate(Printer $printer)
    {
        if ($this->descriptor->file()->getOptions()->getExtension("php")->getMultipleFiles()) {
            $printer->put("<?php\n");
        }

        $this->printUseNameSpaceIfNeeded($printer);

        $printer->put(
            "/**\n" .
            " * Generated by the protocol buffer compiler.  DO NOT EDIT!\n" .
            " * source: `filename`\n" .
            " *\n",
            "filename",
            $this->descriptor->file()->getName()
        );
        $printer->put(" */\n");

        $printer->put("class `name` extends \\ProtocolBuffers\\Enum\n{\n",
            "name",
            $this->descriptor->getName()
        );
        $printer->indent();

        foreach ($this->descriptor->getValue() as $value) {
            $printer->put(
                "const `name` = `number`;\n",
                "name", $this->getEnumValueAsString($value),
                "number", $value->getNumber()
            );
        }

        $printer->put("\n");

        $printer->put("public static function getEnumDescriptor()\n");
        $printer->put("{\n");
        $printer->indent();
        $printer->put("static \$descriptor;\n");
        $printer->put("if (!\$descriptor) {\n");
        $printer->indent();
        $printer->put("\$builder = new \\ProtocolBuffers\\EnumDescriptorBuilder();\n");
        foreach ($this->descriptor->getValue() as $value) {
            $printer->put("\$builder->addValue(new \\ProtocolBuffers\\EnumValueDescriptor(array(\n");
            $printer->indent();
            $printer->put("\"value\" => `value`,\n",
                "value", $value->getNumber());
            $printer->put("\"name\"  => '`name`',\n",
                "name", $value->getName());
            $printer->outdent();
            $printer->put(")));\n");
        }
        $printer->put("\$descriptor = \$builder->build();\n");

        $printer->outdent();
        $printer->put("}\n");
        $printer->put("return \$descriptor;\n");
        $printer->outdent();
        $printer->put("}\n");


        $printer->outdent();
        $printer->put("}\n");

        if ($this->enclose_namespace_) {
            $printer->outdent();
            $printer->put("}\n\n");
        }
    }
}
