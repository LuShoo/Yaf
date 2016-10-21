<?php
namespace Thrift\Server\Box;

use Thrift\Type\TType;
use Thrift\Exception\TProtocolException;

class PageEquipments {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\Box\UserEquipment[]
   */
  public $equipments = null;
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
          'var' => 'equipments',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\Box\UserEquipment',
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
      if (isset($vals['equipments'])) {
        $this->equipments = $vals['equipments'];
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
    return 'PageEquipments';
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
            $this->equipments = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $elem5 = new \Thrift\Server\Box\UserEquipment();
              $xfer += $elem5->read($input);
              $this->equipments []= $elem5;
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
    $xfer += $output->writeStructBegin('PageEquipments');
    if ($this->equipments !== null) {
      if (!is_array($this->equipments)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('equipments', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRUCT, count($this->equipments));
        {
          foreach ($this->equipments as $iter6)
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