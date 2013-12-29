<?php
namespace google\protobuf;

// @@protoc_insertion_point(namespace:.google.protobuf.SourceCodeInfo)

/**
 * Generated by the protocol buffer compiler.  DO NOT EDIT!
 * source: google/protobuf/descriptor.proto
 *
 * -*- magic methods -*-
 *
 * @method array getLocation()
 * @method void appendLocation(array $value)
 */
class SourceCodeInfo extends \ProtocolBuffers\Message
{
  // @@protoc_insertion_point(traits:.google.protobuf.SourceCodeInfo)
  
  /** @var array $location tag:1  optional */
  protected $location;
  
  // @@protoc_insertion_point(properties_scope:.google.protobuf.SourceCodeInfo)

  // @@protoc_insertion_point(class_scope:.google.protobuf.SourceCodeInfo)

  /**
   * get descriptor for protocol buffers
   * 
   * @return \ProtocolBuffersDescriptor
   */
  public static function getDescriptor()
  {
    static $descriptor;
    
    if (!isset($descriptor)) {
      $desc = new \ProtocolBuffers\DescriptorBuilder();
      $desc->addField(1, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "location",
        "required" => false,
        "optional" => false,
        "repeated" => true,
        "packable" => false,
        "default"  => null,
        "message" => "\\google\\protobuf\\SourceCodeInfo\\Location",
      )));
      // @@protoc_insertion_point(builder_scope:.google.protobuf.SourceCodeInfo)

      $descriptor = $desc->build();
    }
    return $descriptor;
  }

}