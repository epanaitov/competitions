
import java.io.*;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 *
 * @author eugene
 */
public class B {
	public static void main(String[] args) {
		BufferedReader in = new BufferedReader(new InputStreamReader(System.in));

		String glued = "";
		try {
			glued = in.readLine();
		} catch (Exception e) {

		}
		
		if ((glued.length() < 3) || (glued.charAt(0) == '@') || (glued.charAt(glued.length()-1) == '@')) {
			System.out.println("No solution");
			return;
		}
		
		Pattern p = Pattern.compile("\\@\\@");
		Matcher m = p.matcher(glued);
		if (m.find()) {
			System.out.println("No solution");
			return;
		}

		p = Pattern.compile("\\@[a-z]\\@");
		m = p.matcher(glued);
		if (m.find()) {
			System.out.println("No solution");
			return;
		}
		
		String[] emails = new String[67];
		int i = 0;

		String chunk = "";
		Boolean at = false;

		char ch = 'a';
		char nch = 'a';
		for (int j = 0; j< glued.length()-1; j++) {
			ch = glued.charAt(j);
			nch = glued.charAt(j+1);
			
			if ((nch == '@') && at) {
				// it's new email
				emails[i] = chunk;
				i++;
				chunk = "";
				at = false;
			}
			chunk+= ch;
			if (ch == '@') at = true;
		}
		chunk+= nch;
		emails[i] = chunk;
		i++;
		
		if (i > 0) {
			for (int j=0; j < i-1; j++) System.out.print(emails[j]+",");
			System.out.println(emails[i-1]);
		} else {
			System.out.println("No solution");
		}
	    
	}
}
