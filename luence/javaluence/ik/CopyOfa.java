package ik;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.StringReader;
import org.apache.lucene.analysis.TokenStream;
import org.apache.lucene.analysis.tokenattributes.CharTermAttribute;
import org.wltea.analyzer.core.IKSegmenter;
import org.wltea.analyzer.core.Lexeme;
import org.wltea.analyzer.lucene.IKAnalyzer;
 
public class CopyOfa {
	public static void main(String[] args) throws IOException {
	   String news = "周淑怡叶氏山庄叶氏山庄";
	   System.out.println(news);
	   IKAnalyzer analyzer = new IKAnalyzer(true);
	   StringReader reader = new StringReader(news);
	   TokenStream ts = analyzer.tokenStream("", reader);
	   CharTermAttribute term = ts.getAttribute(CharTermAttribute.class);

	   analyzer.close();
	   reader.close();
	   
	   System.out.println();
	   StringReader re = new StringReader(news);
	   IKSegmenter ik = new IKSegmenter(re,true);
	   Lexeme lex = null;
	   while((lex=ik.next())!=null){
		   System.out.print(lex.getLexemeText()+"|");
	   }
	}
}
