<?php
namespace Thrift\Server\Card;

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



class Cards {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = null;
  /**
   * @var int
   */
  public $packageID = null;
  /**
   * @var string
   */
  public $ccID = null;
  /**
   * @var string
   */
  public $telephone = null;
  /**
   * @var string
   */
  public $batch = null;
  /**
   * @var string
   */
  public $producedAt = null;
  /**
   * @var int
   */
  public $development = null;
  /**
   * @var int
   */
  public $status = null;
  /**
   * @var string
   */
  public $packageName = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'packageID',
          'type' => TType::I32,
          ),
        3 => array(
          'var' => 'ccID',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'telephone',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'batch',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'producedAt',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'development',
          'type' => TType::I16,
          ),
        8 => array(
          'var' => 'status',
          'type' => TType::I16,
          ),
        9 => array(
          'var' => 'packageName',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['packageID'])) {
        $this->packageID = $vals['packageID'];
      }
      if (isset($vals['ccID'])) {
        $this->ccID = $vals['ccID'];
      }
      if (isset($vals['telephone'])) {
        $this->telephone = $vals['telephone'];
      }
      if (isset($vals['batch'])) {
        $this->batch = $vals['batch'];
      }
      if (isset($vals['producedAt'])) {
        $this->producedAt = $vals['producedAt'];
      }
      if (isset($vals['development'])) {
        $this->development = $vals['development'];
      }
      if (isset($vals['status'])) {
        $this->status = $vals['status'];
      }
      if (isset($vals['packageName'])) {
        $this->packageName = $vals['packageName'];
      }
    }
  }

  public function getName() {
    return 'Cards';
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
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->packageID);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->ccID);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->telephone);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->batch);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->producedAt);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->development);
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
            $xfer += $input->readString($this->packageName);
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
    $xfer += $output->writeStructBegin('Cards');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I32, 1);
      $xfer += $output->writeI32($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->packageID !== null) {
      $xfer += $output->writeFieldBegin('packageID', TType::I32, 2);
      $xfer += $output->writeI32($this->packageID);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->ccID !== null) {
      $xfer += $output->writeFieldBegin('ccID', TType::STRING, 3);
      $xfer += $output->writeString($this->ccID);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->telephone !== null) {
      $xfer += $output->writeFieldBegin('telephone', TType::STRING, 4);
      $xfer += $output->writeString($this->telephone);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->batch !== null) {
      $xfer += $output->writeFieldBegin('batch', TType::STRING, 5);
      $xfer += $output->writeString($this->batch);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->producedAt !== null) {
      $xfer += $output->writeFieldBegin('producedAt', TType::STRING, 6);
      $xfer += $output->writeString($this->producedAt);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->development !== null) {
      $xfer += $output->writeFieldBegin('development', TType::I16, 7);
      $xfer += $output->writeI16($this->development);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->status !== null) {
      $xfer += $output->writeFieldBegin('status', TType::I16, 8);
      $xfer += $output->writeI16($this->status);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->packageName !== null) {
      $xfer += $output->writeFieldBegin('packageName', TType::STRING, 9);
      $xfer += $output->writeString($this->packageName);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PageCards {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\Card\Cards[]
   */
  public $cards = null;
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
          'var' => 'cards',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\Card\Cards',
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
      if (isset($vals['cards'])) {
        $this->cards = $vals['cards'];
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
    return 'PageCards';
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
            $this->cards = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $elem5 = new \Thrift\Server\Card\Cards();
              $xfer += $elem5->read($input);
              $this->cards []= $elem5;
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
    $xfer += $output->writeStructBegin('PageCards');
    if ($this->cards !== null) {
      if (!is_array($this->cards)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('cards', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRUCT, count($this->cards));
        {
          foreach ($this->cards as $iter6)
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

class PagePackages {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\Card\Packages[]
   */
  public $packages = null;
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
          'var' => 'packages',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\Card\Packages',
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
      if (isset($vals['packages'])) {
        $this->packages = $vals['packages'];
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
    return 'PagePackages';
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
            $this->packages = array();
            $_size7 = 0;
            $_etype10 = 0;
            $xfer += $input->readListBegin($_etype10, $_size7);
            for ($_i11 = 0; $_i11 < $_size7; ++$_i11)
            {
              $elem12 = null;
              $elem12 = new \Thrift\Server\Card\Packages();
              $xfer += $elem12->read($input);
              $this->packages []= $elem12;
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
    $xfer += $output->writeStructBegin('PagePackages');
    if ($this->packages !== null) {
      if (!is_array($this->packages)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('packages', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRUCT, count($this->packages));
        {
          foreach ($this->packages as $iter13)
          {
            $xfer += $iter13->write($output);
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

class Recharges {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = null;
  /**
   * @var string
   */
  public $telephone = null;
  /**
   * @var string
   */
  public $rechargedAt = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'telephone',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'rechargedAt',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['telephone'])) {
        $this->telephone = $vals['telephone'];
      }
      if (isset($vals['rechargedAt'])) {
        $this->rechargedAt = $vals['rechargedAt'];
      }
    }
  }

  public function getName() {
    return 'Recharges';
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
            $xfer += $input->readString($this->telephone);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->rechargedAt);
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
    $xfer += $output->writeStructBegin('Recharges');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I32, 1);
      $xfer += $output->writeI32($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->telephone !== null) {
      $xfer += $output->writeFieldBegin('telephone', TType::STRING, 2);
      $xfer += $output->writeString($this->telephone);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->rechargedAt !== null) {
      $xfer += $output->writeFieldBegin('rechargedAt', TType::STRING, 3);
      $xfer += $output->writeString($this->rechargedAt);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class DataNotFoundException extends TException {
  static $_TSPEC;

  /**
   * @var string
   */
  public $message = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'message',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['message'])) {
        $this->message = $vals['message'];
      }
    }
  }

  public function getName() {
    return 'DataNotFoundException';
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
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->message);
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
    $xfer += $output->writeStructBegin('DataNotFoundException');
    if ($this->message !== null) {
      $xfer += $output->writeFieldBegin('message', TType::STRING, 1);
      $xfer += $output->writeString($this->message);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class SaveOrUpdateException extends TException {
  static $_TSPEC;

  /**
   * @var string
   */
  public $message = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'message',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['message'])) {
        $this->message = $vals['message'];
      }
    }
  }

  public function getName() {
    return 'SaveOrUpdateException';
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
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->message);
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
    $xfer += $output->writeStructBegin('SaveOrUpdateException');
    if ($this->message !== null) {
      $xfer += $output->writeFieldBegin('message', TType::STRING, 1);
      $xfer += $output->writeString($this->message);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

