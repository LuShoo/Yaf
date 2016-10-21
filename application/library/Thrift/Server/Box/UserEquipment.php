<?php
namespace Thrift\Server\Box;

use Thrift\Type\TType;

class UserEquipment {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = null;
  /**
   * @var string
   */
  public $sncode = null;
  /**
   * @var string
   */
  public $imei = null;
  /**
   * @var string
   */
  public $mac = null;
  /**
   * @var string
   */
  public $channel = null;
  /**
   * @var string
   */
  public $customer = null;
  /**
   * @var string
   */
  public $orderNumber = null;
  /**
   * @var int
   */
  public $status = null;
  /**
   * @var string
   */
  public $updatedAt = null;
  /**
   * @var string
   */
  public $createdAt = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'sncode',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'imei',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'mac',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'channel',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'customer',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'orderNumber',
          'type' => TType::STRING,
          ),
        8 => array(
          'var' => 'status',
          'type' => TType::I16,
          ),
        9 => array(
          'var' => 'updatedAt',
          'type' => TType::STRING,
          ),
        10 => array(
          'var' => 'createdAt',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['sncode'])) {
        $this->sncode = $vals['sncode'];
      }
      if (isset($vals['imei'])) {
        $this->imei = $vals['imei'];
      }
      if (isset($vals['mac'])) {
        $this->mac = $vals['mac'];
      }
      if (isset($vals['channel'])) {
        $this->channel = $vals['channel'];
      }
      if (isset($vals['customer'])) {
        $this->customer = $vals['customer'];
      }
      if (isset($vals['orderNumber'])) {
        $this->orderNumber = $vals['orderNumber'];
      }
      if (isset($vals['status'])) {
        $this->status = $vals['status'];
      }
      if (isset($vals['updatedAt'])) {
        $this->updatedAt = $vals['updatedAt'];
      }
      if (isset($vals['createdAt'])) {
        $this->createdAt = $vals['createdAt'];
      }
    }
  }

  public function getName() {
    return 'UserEquipment';
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
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->id);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->sncode);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->imei);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->mac);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->channel);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->customer);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->orderNumber);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->status);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->updatedAt);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 10:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->createdAt);
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
    $xfer += $output->writeStructBegin('UserEquipment');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I32, 1);
      $xfer += $output->writeI32($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->sncode !== null) {
      $xfer += $output->writeFieldBegin('sncode', TType::STRING, 2);
      $xfer += $output->writeString($this->sncode);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->imei !== null) {
      $xfer += $output->writeFieldBegin('imei', TType::STRING, 3);
      $xfer += $output->writeString($this->imei);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->mac !== null) {
      $xfer += $output->writeFieldBegin('mac', TType::STRING, 4);
      $xfer += $output->writeString($this->mac);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->channel !== null) {
      $xfer += $output->writeFieldBegin('channel', TType::STRING, 5);
      $xfer += $output->writeString($this->channel);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->customer !== null) {
      $xfer += $output->writeFieldBegin('customer', TType::STRING, 6);
      $xfer += $output->writeString($this->customer);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->orderNumber !== null) {
      $xfer += $output->writeFieldBegin('orderNumber', TType::STRING, 7);
      $xfer += $output->writeString($this->orderNumber);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->status !== null) {
      $xfer += $output->writeFieldBegin('status', TType::I16, 8);
      $xfer += $output->writeI16($this->status);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->updatedAt !== null) {
      $xfer += $output->writeFieldBegin('updatedAt', TType::STRING, 9);
      $xfer += $output->writeString($this->updatedAt);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->createdAt !== null) {
      $xfer += $output->writeFieldBegin('createdAt', TType::STRING, 10);
      $xfer += $output->writeString($this->createdAt);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}