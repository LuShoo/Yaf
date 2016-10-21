<?php
namespace Thrift\Server\Jpush;

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

class JpushMessage {
  static $_TSPEC;

  /**
   * @var string
   */
  public $appName = null;
  /**
   * @var string[]
   */
  public $platform = null;
  /**
   * @var string[]
   */
  public $tag = null;
  /**
   * @var string[]
   */
  public $aliasName = null;
  /**
   * @var string
   */
  public $message = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'appName',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'platform',
          'type' => TType::LST,
          'etype' => TType::STRING,
          'elem' => array(
            'type' => TType::STRING,
            ),
          ),
        3 => array(
          'var' => 'tag',
          'type' => TType::LST,
          'etype' => TType::STRING,
          'elem' => array(
            'type' => TType::STRING,
            ),
          ),
        4 => array(
          'var' => 'aliasName',
          'type' => TType::LST,
          'etype' => TType::STRING,
          'elem' => array(
            'type' => TType::STRING,
            ),
          ),
        5 => array(
          'var' => 'message',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['appName'])) {
        $this->appName = $vals['appName'];
      }
      if (isset($vals['platform'])) {
        $this->platform = $vals['platform'];
      }
      if (isset($vals['tag'])) {
        $this->tag = $vals['tag'];
      }
      if (isset($vals['aliasName'])) {
        $this->aliasName = $vals['aliasName'];
      }
      if (isset($vals['message'])) {
        $this->message = $vals['message'];
      }
    }
  }

  public function getName() {
    return 'JpushMessage';
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
            $xfer += $input->readString($this->appName);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::LST) {
            $this->platform = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $xfer += $input->readString($elem5);
              $this->platform []= $elem5;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::LST) {
            $this->tag = array();
            $_size6 = 0;
            $_etype9 = 0;
            $xfer += $input->readListBegin($_etype9, $_size6);
            for ($_i10 = 0; $_i10 < $_size6; ++$_i10)
            {
              $elem11 = null;
              $xfer += $input->readString($elem11);
              $this->tag []= $elem11;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::LST) {
            $this->aliasName = array();
            $_size12 = 0;
            $_etype15 = 0;
            $xfer += $input->readListBegin($_etype15, $_size12);
            for ($_i16 = 0; $_i16 < $_size12; ++$_i16)
            {
              $elem17 = null;
              $xfer += $input->readString($elem17);
              $this->aliasName []= $elem17;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
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
    $xfer += $output->writeStructBegin('JpushMessage');
    if ($this->appName !== null) {
      $xfer += $output->writeFieldBegin('appName', TType::STRING, 1);
      $xfer += $output->writeString($this->appName);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->platform !== null) {
      if (!is_array($this->platform)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('platform', TType::LST, 2);
      {
        $output->writeListBegin(TType::STRING, count($this->platform));
        {
          foreach ($this->platform as $iter18)
          {
            $xfer += $output->writeString($iter18);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->tag !== null) {
      if (!is_array($this->tag)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('tag', TType::LST, 3);
      {
        $output->writeListBegin(TType::STRING, count($this->tag));
        {
          foreach ($this->tag as $iter19)
          {
            $xfer += $output->writeString($iter19);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->aliasName !== null) {
      if (!is_array($this->aliasName)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('aliasName', TType::LST, 4);
      {
        $output->writeListBegin(TType::STRING, count($this->aliasName));
        {
          foreach ($this->aliasName as $iter20)
          {
            $xfer += $output->writeString($iter20);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->message !== null) {
      $xfer += $output->writeFieldBegin('message', TType::STRING, 5);
      $xfer += $output->writeString($this->message);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}