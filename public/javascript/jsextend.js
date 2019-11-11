if (!Array.prototype.indexOf) {
	// 针对IE8 数组无indexOf方法 实现扩展
	Array.prototype.indexOf = function(n) {
		for ( var i = 0; i < this.length; i++) {
			if (n === this[i]) {
				return i;
			}
		}
		return -1;
	};
}