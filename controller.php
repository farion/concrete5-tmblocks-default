<?php

namespace Concrete\Package\TmblocksDefault;
use Package;
use BlockType;
use SinglePage;
use PageTheme;
use BlockTypeSet;
use CollectionAttributeKey;
use Concrete\Core\Attribute\Type as AttributeType;
use Config;
use Core;
use AssetList;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

  protected $pkgHandle = 'tmblocks-default';
  protected $appVersionRequired = '5.7.5';
  protected $pkgVersion = '1.0.0';


  public function getPackageDescription()
  {
    return t("This package provides some default blocks using tmblocks.");
  }

  public function getPackageName()
  {
    return t("TRIGONmedia Default Blocks");
  }

  protected function installOrUpdateBlock($blockname, $pkg)
  {
    $bt = BlockType::getByHandle($blockname);
    if (!is_object($bt)) {
      BlockType::installBlockTypeFromPackage($blockname, $pkg);
    }
  }

  protected function installOrUpdateBlocks($pkg)
  {

    if (!BlockTypeSet::getByHandle('tmblocks-default')) {
      BlockTypeSet::add('tmblocks-default', "TMBlocks Default", $pkg);
    }

    $this->installOrUpdateBlock("tm_headline", $pkg);
    $this->installOrUpdateBlock("tm_linklist", $pkg);
  }

  public function install()
  {
    $pkg = parent::install();
    $this->installOrUpdateBlocks($pkg);
  }

  public function upgrade()
  {
    parent::upgrade();
    $this->installOrUpdateBlocks($this);
  }

}

?>
