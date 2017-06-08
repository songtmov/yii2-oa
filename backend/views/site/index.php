<?php
use kartik\growl\Growl;
$this->title = 'OA HOME';
?>
<!-- script src="\statics\js\echarts.js"></script>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script> -->

<?php
if(!empty($_SERVER['HTTP_REFERER']) && explode('/',$_SERVER['HTTP_REFERER'])[4] == 'login' ){
	echo Growl::widget([
	    'type' => Growl::TYPE_SUCCESS,
	    'icon' => 'glyphicon glyphicon-ok-sign',
	    'title' => '登陆成功',
	    'showSeparator' => true,
	    'body' => '系统当前版本 v1.34-beta',
	]);
}
?>

<div class="site-index">
<div style="height:500%;width: 500px;margin-left: 33%;margin-top:1%;margin-bottom: 1%;"><center><img id="logo" src="\statics\images\logo2.png"></center></div>
<div class="site-index">
    <div class="jumbotron">
        <h1>欢迎登陆TMOV OA管理系统</h1>
        <p class="lead">TMOV管理系统是一款集成员工管理和客户管理，药品管理的医美行业管理软件</p>
    </div>
</div>

<div id="container" style="height: 800%;width: 100%;"></div>
<div id="main" style="width: 100%;height:800%;"></div>
<div style="margin-bottom: 5%"></div>

</div>

<!-- <script type="text/javascript">
	var dom = document.getElementById("container");
		var myChart = echarts.init(dom);
		var app = {};
		option = null;
		var geoCoordMap = {
		    "青岛":[120.33,36.07],
		    "威海":[122.1,37.5],
		    "鹤壁":[114.17,35.9],
		    "太原":[112.53,37.87],
		    "淄博":[118.05,36.78],
		    "安阳":[114.35,36.1],
		    "郑州":[113.65,34.76],
		    "石家庄":[114.48,38.03],
		};
	var convertData = function (data) {
	    var res = [];
	    for (var i = 0; i < data.length; i++) {
	        var geoCoord = geoCoordMap[data[i].name];
	        if (geoCoord) {
	            res.push({
	                name: data[i].name,
	                value: geoCoord.concat(data[i].value)
	            });
	        }
	    }
	    return res;
	};

	option = {
	    backgroundColor: '#FFFFFF',
	    title: {
	        text: 'TMOV',
	        subtext: 'data from TMOV.OA',
	        sublink: 'http://www.pm25.in',
	        x:'center',
	        textStyle: {
	            color: '#fff'
	        }
	    },
	    tooltip: {
	        trigger: 'item',
	        formatter: function (params) {
	            return params.name + ' : ' + params.value[2];
	        }
	    },
	    legend: {
	        orient: 'vertical',
	        y: 'bottom',
	        x:'right',
	        data:['pm2.5'],
	        textStyle: {
	            color: '#fff'
	        }
	    },
	    visualMap: {
	        min: 0,
	        max: 200,
	        calculable: true,
	        inRange: {
	            color: ['#50a3ba', '#eac736', '#d94e5d']
	        },
	        textStyle: {
	            color: '#fff'
	        }
	    },
	    geo: {
	        map: 'china',
	        label: {
	            emphasis: {
	                show: false
	            }
	        },
	        itemStyle: {
	            normal: {
	                areaColor: '#323c48',
	                borderColor: '#111'
	            },
	            emphasis: {
	                areaColor: '#2a333d'
	            }
	        }
	    },
	    series: [
	        {
	            name: '状态',
	            type: 'scatter',
	            coordinateSystem: 'geo',
	            data: convertData([
	                {name: "青岛", value: 18},
	                {name: "威海", value: 25},
	                {name: "鹤壁", value: 25},
	                {name: "太原", value: 39},
	                {name: "淄博", value: 85},
	                {name: "安阳", value: 90},
	                {name: "郑州", value: 113},
	                {name: "石家庄", value: 147},
	            ]),
	            symbolSize: 12,
	            label: {
	                normal: {
	                    show: false
	                },
	                emphasis: {
	                    show: false
	                }
	            },
	            itemStyle: {
	                emphasis: {
	                    borderColor: '#fff',
	                    borderWidth: 1
	                }
	            }
	        }
	    ]
	};
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));
    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '　　　　　　　　　TMOV　营业额数据图'
        },
        tooltip: {},
        legend: {
            data:['销量']
        },
        xAxis: {
            data: ["青岛","郑州","驻马店","鹤壁","太原","濮阳",]
        },
        yAxis: {},
        series: [{
            name: '总营业额',
            type: 'bar',
            data: [5, 20, 36, 10, 10, 20]
        }]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    var myChart = echarts.init(document.getElementById('main-left'));
    var option = {
    backgroundColor: '#2c343c',
    visualMap: {
        show: false,
        min: 80,
        max: 600,
        inRange: {
            colorLightness: [0, 1]
        }
    },
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius: '55%',
            data:[
                {value:235, name:'视频广告'},
                {value:274, name:'联盟广告'},
                {value:310, name:'邮件营销'},
                {value:335, name:'直接访问'},
                {value:400, name:'搜索引擎'}
            ],
            roseType: 'angle',
            label: {
                normal: {
                    textStyle: {
                        color: 'rgba(255, 255, 255, 0.3)'
                    }
                }
            },
            labelLine: {
                normal: {
                    lineStyle: {
                        color: 'rgba(255, 255, 255, 0.3)'
                    }
                }
            },
            itemStyle: {
                normal: {
                    color: '#c23531',
                    shadowBlur: 200,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
}
myChart.setOption(option);
</script> -->

<script type="text/javascript">
	//  获取窗口宽度
	if (window.innerWidth)
	winWidth = window.innerWidth;
	else if ((document.body) && (document.body.clientWidth))
	winWidth = document.body.clientWidth;
	
	// 获取窗口高度
	if (window.innerHeight)
	winHeight = window.innerHeight;
	else if ((document.body) && (document.body.clientHeight))
	winHeight = document.body.clientHeight;
	
	// 通过深入 Document 内部对 body 进行检测，获取窗口大小
	if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth)
	{
		winHeight = document.documentElement.clientHeight;

		winWidth = document.documentElement.clientWidth;
	}

	console.log(winHeight);
	console.log(winWidth);

	if(winHeight < 569 && winWidth < 1260){
		$('#logo').attr('src','/statics/images/logo2.png');
	}
</script> 