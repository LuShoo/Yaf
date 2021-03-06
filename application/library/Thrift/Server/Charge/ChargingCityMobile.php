<?php
namespace Thrift\Server\Charge;

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


class ChargingCityMobile {
  static $_TSPEC;

  /**
   * @var string
   */
  public $province = "";
  /**
   * @var string
   */
  public $city = "";
  /**
   * @var string
   */
  public $provider = "";

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'province',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'city',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'provider',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['province'])) {
        $this->province = $vals['province'];
      }
      if (isset($vals['city'])) {
        $this->city = $vals['city'];
      }
      if (isset($vals['provider'])) {
        $this->provider = $vals['provider'];
      }
    }
  }

  public function getName() {
    return 'ChargingCityMobile';
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
            $xfer += $input->readString($this->province);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->city);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->provider);
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
    $xfer += $output->writeStructBegin('ChargingCityMobile');
    if ($this->province !== null) {
      $xfer += $output->writeFieldBegin('province', TType::STRING, 1);
      $xfer += $output->writeString($this->province);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->city !== null) {
      $xfer += $output->writeFieldBegin('city', TType::STRING, 2);
      $xfer += $output->writeString($this->city);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->provider !== null) {
      $xfer += $output->writeFieldBegin('provider', TType::STRING, 3);
      $xfer += $output->writeString($this->provider);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

