var arr_province = ["province","Beijing Municipality","Tianjin Municipality","Hebei Province","Shanxi Province","Inner Mongolia Autonomous Region","Liaoning Province","Jilin Province","Heilongjiang Province","Shanghai Municipality","Jiangsu Province","Zhejiang Province","Anhui Province","Fujian Province","Jiangxi Province","Shandong Province","Henan Province","Hubei Province","Hunan Province","Guangdong Province","Guangxi Autonomous Region","Hainan Province","Chongqing Municipality","Sichuan Province","Guizhou Province","Yunnan Province","Tibet Autonomous Region","Shaanxi Province","Gansu Province","Qinghai Province","Ningxia Province","Xinjiang Province","Taiwan (disputed)","Hong Kong Special Administrative Region","Macau Special Administrative Region"];
var arr_city = [
				["ville"],
				["Beijing","Yongning"],
				["Tianjin","Autres"],
				["Tangshan","Yanqing","Zhangjiakou","Baoding","Qinhuangdao","Shijiazhuang","Xingtai","Autres"],
				["Datong","Yongji","Linfen","Changzhi","Xinzhou","Taiyuan","Autres"],
				["Bayanhot","Ejin Banner","Badanjilin","Chifeng","Erdos","Erenhot","Arxan","Hohhot","Hailar","Baotou","Tongliao","Wuhai","Ulanhot","Xilinhot","Bavannur","Zhalantun","Autres"],
				["Dandong","Jinxi","Jinzhou","Shenyang","Dalian","Anshan","Changhai","Chaoyang","Fuxin","Yingkou","Autres"],
				["Baicheng","Baishan","Changchun","Jilin","Tonghua","Yanji","Autres"],
				["Harbin","Mohe","Daqing Shi","Jiagedaqi","Fuyuan","Heihe","Jiamusi","Jixi","Yichun","Mudanjiang","Qiqihar","Tahe","Autres"],
				["Shanghai"],
				["Nanjing","Nantong","Huai\'an","Changzhou","Lianyungang","Rugao","Suzhou","Wuxi","Xuzhou","Yangzhou and Taizhou","Yancheng","Autres"],
				["Hangzhou","Quzhou","Huangyan","Ningbo","Wenzhou","Yiwu","Zhoushan","Autres"],
				["Chizhou","Anqing","Bengbu","Hefei","Huangshan","Wuhu","Autres"],
				["Fuzhou","Sanming","Xiamen","Longyan","Quanzhou","Wuyishan","Autres"],
				["Ji\'an","Nanchang","Shangrao","Ganzhou","Jingdezhen","Jiujiang","Yichun","Autres"],
				["Dongying","Jining","Jinan","Linyi","Qingdao","Rizhao","Weifang","Weihai","Yantai","Autres"],
				["Shangqiu","Kaifeng","Zhengzhou","Anyang","Luoyang","Nanyang","Autres"],
				["Dangyang","Yichang","Wuhan","Handan","Guanghua","Enshi","Shennongjia","Shashi","Shiyan","Xiangfang","Autres"],
				["Yeuyang","Changsha","Yueyang","Changde","Huaihua","Dayong","Hengyang","Yongzhou","Autres"],
				["Guangzhou","Shantou","Foshan","Huizhou","Shaoguan","Louding City","Meixian","Zhuhai","Shenzhen","Xingning","Zhanjiang","Autres"],
				["Baise","Beihai","Hechi","Guilin City","Nanning","Wuzhou","Liuzhou","Autres"],
				["Dongyu Island","Haikou","Qionghai","Sanya","Woody Island","Autres"],
				["Chongqing","Dazu","Qianjiang","Liangping","Wanxian"],
				["Aba","Panzhihua","Zigong","Leshan","Bazhong","Dazhou","Guangyuan","Jiuzhaigou","Luzhou","Mianyang","Nanchong","Suining","Chengdu","Xichang","Yibin","Autres"],
				["Guiyang","Bijie","Huangping","Liping","Xingyi","Zunyi","Autres"],
				["Yuanmou","Kunming","Yuanjiang","Lincang","Ninglang","Xiaguan","Shangri-La","Jinghong","Lijiang","Luxi","Pu\'er","Wenshan","Zhaotong","Tengchong","Autres"],
				["Xigazê","Shiquanhe","Bangda","Lhasa","Nyingchi","Autres"],
				["Hanzhong","Danfeng","Yuncheng","Ankang","Pucheng","Xi\'an","Yan\'an","Yulin","Autres"],
				["Lanzhou","Tianshui","Zhangye","Jinchang","Dunhuang","Jiayuguan","Qingyang","Xiahe","Autres"],
				["Haibei","Golog","Delingha","Golmud","Mengnai","Xining","Yusu","Autres"],
				["Yinchuan","Guyuan","Zhongwei"],
				["Altay","Shihezi","Aksu","Bole","Qiemo","Fuyun","Hami","Kuqa","Korla","Karamay","Burqin","Xinyuan County","Kashgar","Shanshan","Tacheng","Hotan","Turpan","Ürümqi","Yining","Autres"],
				["Autres"],
				["Autres"],
				["Autres"]
			];

onload = function(){
	var oForm = document.getElementById('recherche_detail');
	var oProvince = oForm.children[2];
	var oCity = oForm.children[4];

	oProvince.onchange = function(){
		var _this = this.selectedIndex;
		oCity.length = 0;
		initCity(_this);
	};

	init();

	function init(){
		var index = 0;
		oProvince.length = arr_province.length;

		for (var i = 0; i < arr_province.length; i++) {
			oProvince.options[i].text = arr_province[i];
			oProvince.options[i].value = arr_province[i];
		}

		oProvince.selectedIndex = index;
		initCity(index);
	}

	function initCity(index){
		oCity.length = arr_city[index].length;

		for(var i = 0; i < arr_city[index].length; i++){
			oCity.options[i].text = arr_city[index][i];
			if (arr_city[index][i] == "Autres") {
				oCity.options[i].value = "";
			}
			else{
				oCity.options[i].value = arr_city[index][i];
			}
		}
	}
}
