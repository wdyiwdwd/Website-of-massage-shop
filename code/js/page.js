var pageSize=7; //每页的个数
var curpage; //当前页
var lastpage; //最后一页
var direct; //方向
var len; //总行数
var page; //总页数
var begin; //表格从何处开始
var end; //表格从何处结束

$(window).load(function display(){
	//pageSize=7;
	curpage=1;
	direct=0;
	len=$('#mytable tr').length-1;  //求总行数
	page=len % pageSize==0? len/pageSize : Math.floor(len/pageSize)+1; //计算页数
	lastpage=page;
	//alert('page==='+len);
	displayPage();


	//首页
	$('#firstpage').click(function firstPage(){
		curpage=1;
		direct=0;
		displayPage();
	});

	//上一页
	$('#frontpage').click(function frontPage(){
		direct=-1;
		displayPage();
	});

	//下一页
	$('#nextpage').click(function nextPage(){
		direct=1;
		displayPage();
	});

	//尾页
	$('#lastpage').click(function lastPage(){
		curpage=lastpage;
		direct=0;
		displayPage();
	});

	//改变页面
	$('#changepage').click(function changePage(){
		curpage=document.getElementById("thepage").value;
		if(!/^[0-9]\d*$/.test(curpage)){
			alert("请输入正整数!");
			return;
		}
		if(curpage>page){
			alert("超出数据页面!");
			return;
		}
		direct=0;
		curpage=parseInt(curpage);
		displayPage();
	});

	function displayPage(){
		if(curpage<=1 && direct==-1){
			direct=0;
			alert("已经是第一页了!");
			return;
		}
		else if(curpage>=page && direct==1){
			direct=0;
			alert("已经是最后一页了!");
			return;
		}
		//lastpage=curpage;
		//修复当len=1时，curpage=0的bug
		/*if(len>pageSize){
			curpage=((curpage+direct+len)%len);
		}
		else{
			curpage=1;
		}*/
		curpage=curpage+direct;
		document.getElementById("pageInfo").innerHTML="当前"+curpage+"/"+page+"页";
		document.getElementById("dataInfo").innerHTML="共计"+len+"条";  //显示数据量
		document.getElementById("thepage").value=curpage;
		begin=(curpage-1)*pageSize + 1;
		end=begin + 1*pageSize - 1;
		end=end>len? len:end;
		$('#mytable tr').hide(0);
		$('#mytable tr').each(function(i){
			if(i>=begin && i<=end || i==0){ //显示
				$(this).show(0);
			}
		});
		$(".panel-group").height($(".content").height());
		//$(".content").height($('#thepage').offset().top+30);
		//$(".panel-group").height($(".content").height()-26);
	}
})
