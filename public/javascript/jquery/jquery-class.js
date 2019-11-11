(function ($){

 _Class=function(){
	var initializing=0,fnTest=/\b_super\b/,
		Class=function(){};
	Class.prototype={
		ops:function(o1,o2){
			o2=o2||{};
			for(var key in o1){
				this['_'+key]=key in o2?o2[key]:o1[key];
			}
		}
	};
	Class.extend=function(prop){
		var _super = this.prototype;
		initializing=1;//������ʼ��,��ֹ����ִ�г�ʼ��
		var _prototype=new this();//ֻ��ͨ�������̳У����Ǵ�����
		initializing=0;//������ʼ��
		function fn(name, fn) {
			return function() {
				this._super = _super[name];//���泬�෽������this����ͨ��apply�ı�ɱ���������
				var ret = fn.apply(this, arguments);//�������������Ҹı�thisָ��
				return ret;//���ظղŴ����ķ���
			};
		}
		var _mtd;//��ʱ�������淽��
		for (var name in prop){//���������������з���
			_mtd=prop[name];
			_prototype[name] =(typeof _mtd=='function'&&
			typeof _super[name]=='function'&&
			fnTest.test(_mtd))?fn(name,_mtd):_mtd;//���紫�������Ǻ����������Ƿ���ó���ļ���������Ƿ񱣴泬��
		}
		function F(arg1) {//���캯��������û�б���ʼ���������г�ʼ��������ִ�г�ʼ��
			if(this.constructor!=Object){
				return new F({
					FID:'JClassArguments',
					val:arguments
				});
			}
			if (!initializing&&this.init){
				if(arg1&&arg1.FID&&arg1.FID=='JClassArguments'){
					this.init.apply(this, arg1.val);
				}else{
					this.init.apply(this, arguments);
				}
				this.init=null;

}
        }
		F.prototype=_prototype;//����������
		F.constructor=F;//������
		F.extend=arguments.callee;
		return F;
	};
	return Class;
 }();
	$.Class=function(ops){
		return _Class.extend(typeof ops=='function'?ops():ops);
	};

})(jQuery);