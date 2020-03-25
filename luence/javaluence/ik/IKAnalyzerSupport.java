package ik;
import java.io.IOException;
import java.io.StringReader;
import java.util.ArrayList;
import java.util.List;

import org.apache.lucene.analysis.Analyzer;
import org.apache.lucene.analysis.TokenStream;
import org.apache.lucene.analysis.tokenattributes.CharTermAttribute;
import org.wltea.analyzer.cfg.Configuration;
import org.wltea.analyzer.cfg.DefaultConfig;
import org.wltea.analyzer.dic.Dictionary;
import org.wltea.analyzer.lucene.IKAnalyzer;

public class IKAnalyzerSupport {
	     public static void main(String[] args) throws Exception {
		 
		         // 检索内容
		         String text = "据说赌博要推出iPhone6要出了？与iPhone5s土豪金相比华夏怎样呢？神圣纪事，天空之城，囧囧@2014巴西世界杯 test中文"
		                 + "我在漫长的纠结与反省中觉悟到时间其实改变不了什么的，至少对于放弃一种好的而去相信一种坏的甚至慵懒的事物是这样的。我曾经朝九晚五，不会去日晒雨淋，坐在舒适的办公环境里，友好的同事关系，虽然工资不高，生活却也是很惬意的，如果习惯了，时间它能改变些什么呢?我不知道，也不曾去幻想，因为眼前的景物足够我安静的睡去，做足了美梦，只觉得哪怕是睁开眼睛都是件疲惫的事情，都是一件多余的事情，不必去动脑经想生活的意义是什么?";
		         List<String> list = new ArrayList<String>();
		         list.add("test中文");
		         // 尚未初始化，因为第一次执行分词的时候才会初始化，为了在执行分此前手动添加额外的字典，需要先手动的初始化一下
		         Configuration configuration = DefaultConfig.getInstance();
		         // 主字典路径
		         String mainDictionaryPath = configuration.getMainDictionary();
		         // 量词字典路径
		         String quantifierDictionaryPath = configuration.getQuantifierDicionary();
		         // 获取停止词（stopword）字典路径列表，可一次返回多个停止词词典
		         List<String> stopList = configuration.getExtStopWordDictionarys();
		         // 获取扩展字典路径列表，可一次返回多个扩展词典
		         List<String> extlist = configuration.getExtDictionarys();
		         //System.out.println(mainDictionaryPath);
		         //System.out.println(quantifierDictionaryPath);
		         for (String word : extlist) {
		             System.out.println(word+"as");
		         }
		         for (String word : stopList) {
		             System.out.println(word);
		         }
		         // DictionaryIK 分词器的词典对象
		         // initial 初始化字典实例 字典采用单例模式，一旦初始化，实例就固定 注意该方法只能调用一次
		         Dictionary.initial(configuration);
		         // getSingleton 获取初始化完毕的字典单例
		         // addWords 加载用户扩展的词汇列表到 IK 的主词典中，增加分词器的可识别词语
		         Dictionary.getSingleton().addWords(list);
		         // disableWords(Collection<String> words) 屏蔽词典中的词元
		 
		         // 创建分词对象 true为smart模式
		         Analyzer analyzer = new IKAnalyzer(true);
		         StringReader reader = new StringReader(text);
		 
		         TokenStream ts = analyzer.tokenStream("", reader);
		         CharTermAttribute term = ts.getAttribute(CharTermAttribute.class);
		         // 遍历分词数据
		         //System.out.println(term);
		     }
}
