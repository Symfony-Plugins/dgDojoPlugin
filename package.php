<?php

require_once('PEAR/PackageFileManager2.php');
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$packageXml = new PEAR_PackageFileManager2();

$e = $packageXml->setOptions( array(
    'baseinstalldir' => 'dgDojoPlugin',
    'packagedirectory' => '/home/dnglaze/development/dgDojoPlugin',
    'filelistgenerator' => 'svn',
    'ignore' => array( 'package.xml', 'package.php' ),
    'installexceptions' => array(),
    'dir_roles' => array(),
    'exceptions' => array( 'README' => 'php',
                           'LICENSE' => 'php' ) ) );

$packageXml->setPackage( 'dgDojoPlugin' );
$packageXml->setChannel( 'pear.symfony-project.com' );
$packageXml->setSummary( 'Dojo replacement for Prototype libraries.' );
$packageXml->setDescription( 'Brings various helpers and widgets that use Dojo.');
$packageXml->setAPIVersion( '0.1.0' );
$packageXml->setReleaseVersion( '0.1.0' );
$packageXml->setReleaseStability( 'alpha' );
$packageXml->setAPIStability( 'alpha' );
$packageXml->setNotes( 'This is the first implementation of everything.' );
$packageXml->setPackageType( 'php' );
$packageXml->addRelease();
$packageXml->setPhpDep( '5.2.0' );
$packageXml->addPackageDepWithChannel( 'pkg', 'symfony', 'pear.symfony-project.com', '1.1.0' );
$packageXml->setPearinstallerDep( '1.4.1' );
$packageXml->addMaintainer( 'lead', 'Dean.Glazeski', 'Dean Glazeski', 'dnglaze@gmail.com' );
$packageXml->setLicense( 'MIT License', false, './LICENSE' );
$packageXml->generateContents();

$pkg = &$packageXml->exportCompatiblePackageFile1();

$pkg->writePackageFile();
$packageXml->writePackageFile();
?>
