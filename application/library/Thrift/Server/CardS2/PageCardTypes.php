<?php
namespace Thrift\Server\CardS2;

/**
 * Autogenerated by Thrift Compiler (0.9.2)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


class PageCardTypes {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\CardS2\CardType[]
   */
  public $cardType = null;
  /**
   * @var int
   */
  public $totalPage = null;
  /**
   * @var int
   */
  public $totalNumber = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'cardType',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\CardS2\CardType',
            ),
          ),
        2 => array(
          'var' => 'totalPage',
          'type' => TType::I32,
          ),
        3 => array(
          'var' => 'totalNumber',
          'type' => TType::I32,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['cardType'])) {
        $this->cardType = $vals['cardType'];
      }
      if (isset($vals['totalPage'])) {
        $this->totalPage = $vals['totalPage'];
      }
      if (isset($vals['totalNumber'])) {
        $this->totalNumber = $vals['totalNumber'];
      }
    }
  }

  public function getName() {
    return 'PageCardTypes';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::LST) {
            $this->cardType = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $elem5 = new \Thrift\Server\CardS2\CardType();
              $xfer += $elem5->read($input);
              $this->cardType []= $elem5;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->totalPage);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->totalNumber);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PageCardTypes');
    if ($this->cardType !== null) {
      if (!is_array($this->cardType)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('cardType', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRUCT, count($this->cardType));
        {
          foreach ($this->cardType as $iter6)
          {
            $xfer += $iter6->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->totalPage !== null) {
      $xfer += $output->writeFieldBegin('totalPage', TType::I32, 2);
      $xfer += $output->writeI32($this->totalPage);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->totalNumber !== null) {
      $xfer += $output->writeFieldBegin('totalNumber', TType::I32, 3);
      $xfer += $output->writeI32($this->totalNumber);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

