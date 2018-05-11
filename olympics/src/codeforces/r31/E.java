
import java.io.*;
/**
 *
 * @author eugene
 */
public class E {
	
	public static void main(String[] args) {
		BufferedReader in = new BufferedReader(new InputStreamReader(System.in));

		int n = 0;
		String A = "";
		int[] s = new int[36];

		try {
			n = Integer.parseInt(in.readLine().trim());
			A = in.readLine().trim();
		} catch (Exception e) {
			System.out.println(e);
		}

		int max1 = 0;
		int i_max1 = 0;

		int l1 = 0;
		int l2 = 0;

		for (int i=0; i<=n; i++) {
			int digit = A.charAt(i) - '0';
			if (digit > max1) {
				max1 = digit;
				i_max1 = i;
			}
		}

		s[i_max1] = 1;
		l2++;
		if (i_max1 > 0) {
			for (int i = 0; i < i_max1; i++) {
				l1++;
				s[i] = 2;
			}
		}

		int l = n - Math.max(l1, l2);

		int max2 = 0;
		int i_max2 = 0;

		for (int i=i_max1+1; i <= i_max1+l+1; i++) {
			int digit = A.charAt(i) - '0';
			if (digit > max2) {
				max2 = digit;
				i_max2 = i;
			}
		}

		s[i_max2] = 1;
		if (i_max2 > i_max1+1) {
			for (int i=i_max1+1; i < i_max2; i++) s[i] = 2;
		}

		System.out.print("xyu");

	}
}
