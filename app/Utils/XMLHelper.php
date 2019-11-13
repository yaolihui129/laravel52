<?php

namespace App\Utils;

class XMLHelper {

    /**
     * XMLHelper::openDoc;
     *
     * @param  $xml
     * @param string $version
     * @param string $encoding
     * @return \DOMDocument
     */
	public static function openDoc($xml, $version = "1.0", $encoding = "utf-8") {
		$doc = new \DOMDocument ( $version, $encoding );
		$doc->load ( $xml );
		return $doc;
	}

    /**
     * 获取节点列表
     *
     * @param \DOMDocument $doc
     * @param unknown $nodeName
     * @return \DOMNodeList
     */
	public static function getNodeList(\DOMDocument $doc, $nodeName) {
		return $doc->getElementsByTagName ( $nodeName );
	}

    /**
     * 新建节点
     *
     * @param \DOMDocument $doc
     * @param  $parentNode
     * @param  $nodeName
     * @param string $nodeText
     * @return \DOMElement
     */
	public static function createNode(\DOMDocument $doc, $parentNode, $nodeName, $nodeText = '') {
		$parentEleList = $doc->getElementsByTagName ( $parentNode ); // 获取父节点
		$newNode = $doc->createElement ( $nodeName ); // 创建新节点
		if (! empty ( $nodeText ))
			$newNode->nodeValue = $nodeText; // 设置新节点的Text
		$parentEleList->item ( 0 )->appendChild ( $newNode ); // 添加
		return $newNode;
	}

    /**
     * 获取节点值 返回节点Text
     * XMLHelper::getNodeValue ( $doc, 'ResMark1' );
     *
     * @param \DOMDocument $doc
     *            doc对象
     * @param  $nodeName
     *            节点名称 如：ResMark
     * @return string
     */
	public static function getNodeValue(\DOMDocument $doc, $nodeName) {
		$val = "NO NODE";
		$node = $doc->getElementsByTagName ( $nodeName )->item ( 0 );
		if (empty ( $node ))
			$val = $node->nodeValue;
		return $val;
	}

    /**
     * XMLHelper::updateNodeValue(doc,"ResMark1","")
     *
     * @param \DOMDocument $doc
     * @param  $nodeName
     * @param  $nodeText
     * @return \DOMDocument
     */
	public static function updateNodeValue(\DOMDocument $doc, $nodeName, $nodeText) {
		$node = $doc->getElementsByTagName ( $nodeName )->item ( 0 );
		if (empty ( $node ))
			$node->nodeValue = $nodeText;
		return $doc;
	}

    /**
     * 创建节点中的属性 返回新的doc对象
     * XMLHelper::setAttribute($doc, 'ResMark1', 'ResMarkvalue', 'myVal');
     *
     * @param \DOMDocument $doc doc对象
     * @param  $nodeName 节点名称 如：ResMark
     * @param  $attrName 属性
     * @param  $attrVal 属性值
     * @return \DOMDocument
     */
	public static function setAttribute(\DOMDocument $doc, $nodeName, $attrName, $attrVal) {
		$nodeList = $doc->getElementsByTagName ( $nodeName );
		$node = $nodeList->item ( 0 );
		$node->setAttribute ( $attrName, $attrVal );
		return $doc;
	}
	
	/**
	 * 获取指定节点属性的值 返回节点Text
	 * XMLHelper::getAttrValue($doc, 'ResMark1', 'ResMarkvalue');
	 *
	 * @param \DOMDocument $doc
	 *        	doc对象
	 * @param unknown $nodeName
	 *        	节点名称 如：ResMark
	 * @param unknown $attrName
	 *        	属性
	 * @return unknown
	 */
	public static function getAttrValue(\DOMDocument $doc, $nodeName, $attrName) {
		$nodeList = $doc->getElementsByTagName ( $nodeName );
		$node = $nodeList->item ( 0 );
		if (! empty ( $node ))
			$val = $node->getAttribute ( $attrName );
		return $doc;
	}

    /**
     *
     * @param \DOMDocument $doc
     * @param $parentNode
     * @param $nodeName
     * @param string $nodeText
     * @return \DOMElement
     */
	public static function createChildNode(\DOMDocument $doc, $parentNode, $nodeName, $nodeText = "") {
		$newNode = $doc->createElement ( $nodeName ); // 创建新节点
		if (! empty ( $nodeText ))
			$newNode->nodeValue = $nodeText; // 设置新节点的Text
		$parentNode->appendChild ( $newNode ); // 添加
		return $newNode;
	}

    /**
     *
     * @param  $node
     * @param  $attrName
     * @return mixed
     */
	public static function getNodeAttrValue($node, $attrName) {
		return $node->getAttribute ( $attrName );
	}
	
	/**
	 *
	 * @param  $node
	 * @param  $attrName
	 * @param  $attrVal
	 */
	public static function setNodeAttr($node, $attrName, $attrVal) {
		$node->setAttribute ( $attrName, $attrVal );
	}
	
	/**
	 * 删除属性
	 *
	 * @param \DOMDocument $doc        	
	 * @param  $nodeName
	 * @param  $attrName
	 */
	public static function removeAttr(\DOMDocument $doc, $nodeName, $attrName) {
		$nodeList = $doc->getElementsByTagName ( $nodeName );
		$node = $nodeList->item ( 0 );
		$node->removeAttribute ( $attrName );
	}
	
	/**
	 *
	 * @param \DOMDocument $doc        	
	 * @param  $xml
	 */
	public static function save(\DOMDocument $doc, $xml) {
		$doc->save ( $xml );
	}
}

