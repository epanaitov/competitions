

import java.io.*;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 *
 * @author eugene
 */
public class B1 {
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


                p = Pattern.compile("([a-z]+@[a-z]+)+");
                String[] emails = new String[67];
                int i = 0;
				m = p.matcher(glued);
                while (m.matches()) {
					emails[i] = m.group(1);
					m.reset(glued = glued.substring(0, glued.length() - emails[i].length()));
					i++;
                }

                if (i > 0) {
                        for (int j=i-1; j > 0; j--) System.out.print(emails[j]+",");
                        System.out.println(emails[0]);
                } else {
                        System.out.println("No solution");
                }
        }
}