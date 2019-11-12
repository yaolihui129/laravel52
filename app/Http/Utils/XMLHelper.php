<?php

namespace App\Http\Utils;

class XMLHelper {
	
	/**
	 * 获取一个XmlDocument模版文件
	 * $xmlHelper->getXMLDocModel ();
	 * ResCode 0 成功 1 失败 ResDetail 返回详情描述（如成功、失败异常信息、登录超时等）
	 */
	public static function getXMLDocModel() {
		$xmlModel = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		$xmlModel .= "	<ZX>";
		$xmlModel .= "		<ResultInfo>";
		$xmlModel .= "			<ResMark>0</ResMark>";
		$xmlModel .= "			<ResDetail/>";
		$xmlModel .= "		</ResultInfo>";
		$xmlModel .= "	</ZX>";
		
		$doc = new \DOMDocument ( '1.0', 'utf-8' );
		$doc->loadXML ( $xmlModel );
		
		return $doc;
	}

    /**
     * 创建新节点 返回新的doc对象
     * $xmlHelper->createNode ( $doc, 'ResMark1', "1" );
     *
     * @param \DOMDocument $doc
     *            doc对象
     * @param unknown $nodeName
     *            节点名称 如：ResMark
     * @param string $nodeText
     *            节点Text
     * @param string $parentNode
     *            要增加节点所依赖的父节点 如ResultInfo
     * @return \DOMDocument
     */
	public static function createNode(\DOMDocument $doc, $nodeName, $nodeText = '', $parentNode = 'ResultInfo') {
		$parentEleList = $doc->getElementsByTagName ( $parentNode ); // 获取父节点
		$newNode = $doc->createElement ( $nodeName ); // 创建新节点
		if (! empty ( $nodeText ))
			$newNode->nodeValue = "zhangfj"; // 设置新节点的Text
		$parentEleList->item ( 0 )->appendChild ( $newNode ); // 添加
		return $doc; // 不返回也可以 因为在php5以后 对象传递为引用传递 其他值类型可用&实现引用传递
	}
	
	/**
	 * 获取节点值 返回节点Text
	 * $xmlHelper->getNodeValue ( $doc, 'ResMark1' );
	 *
	 * @param \DOMDocument $doc
	 *        	doc对象
	 * @param unknown $nodeName
	 *        	节点名称 如：ResMark
	 * @return unknown
	 */
	public static function getNodeValue(\DOMDocument $doc, $nodeName) {
		$val = "NO NODE";
		$node = $doc->getElementsByTagName ( $nodeName )->item ( 0 );
		if (empty ( $node ))
			$val = $node->nodeValue;
		return $val;
	}

    /**
     * 创建节点中的属性 返回新的doc对象
     * $xmlHelper->createAttribute($doc, 'ResMark1', 'ResMarkvalue', 'myVal');
     *
     * @param \DOMDocument $doc
     *            doc对象
     * @param  $nodeName
     *            节点名称 如：ResMark
     * @param  $attrName
     *            属性
     * @param  $attrVal
     *            属性值
     * @return \DOMDocument
     */
	public static function createAttribute(\DOMDocument $doc, $nodeName, $attrName, $attrVal) {
		$nodeList = $doc->getElementsByTagName ( $nodeName );
		$node = $nodeList->item ( 0 );
		$node->setAttribute ( $attrName, $attrVal );
		return $doc;
	}

    /**
     * 获取指定节点属性的值 返回节点Text
     * $xmlHelper->getAttrValue($doc, 'ResMark1', 'ResMarkvalue');
     *
     * @param \DOMDocument $doc
     *            doc对象
     * @param  $nodeName
     *            节点名称 如：ResMark
     * @param  $attrName
     *            属性
     * @return string
     */
	public static function getAttrValue(\DOMDocument $doc, $nodeName, $attrName) {
		$val = "NO ATTR";
		try {
			$nodeList = $doc->getElementsByTagName ( $nodeName );
			$node = $nodeList->item ( 0 );
			if (! empty ( $node ))
				$val = $node->getAttribute ( $attrName );
		} catch ( \Exception $e ) {
		}
		return $val;
	}
}

