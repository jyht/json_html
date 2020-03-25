package page;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class file {
	public static void main(String[] args)  {
        try {
            BufferedReader in = new BufferedReader(new FileReader("test.log"));
            String str;   
            ArrayList<String> list=new ArrayList<String>();
            //list.add("asds");
            //list.add("asdsd");
            while ((str = in.readLine()) != null) {
            	list.add(str);
            	//System.out.println(str);
            }
            System.out.println(list);
            
        } catch (IOException e) {
        	System.out.println("停用词文件没找到");
        }
    }
}
