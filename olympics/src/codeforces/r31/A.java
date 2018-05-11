
import java.io.*;

/**
 *
 * @author eugene
 */
public class A {
	public static void main(String[] args) {

		BufferedReader in = new BufferedReader(new InputStreamReader(System.in));
		Integer n = 0;
		int[] worms = new int[100];
		try {
			n = Integer.parseInt(in.readLine());
			String[] raw = in.readLine().split(" ");
			for (int i=0; i<n; i++) worms[i] = Integer.parseInt(raw[i]);
		} catch (Exception e) {
			
		}

		for (int i=0; i<n; i++) {
			for (int j=0; j<n-1; j++) {
				if (i == j) continue;
				for (int k=0; k<n; k++) {
					if (k == j) continue;
					if (k == i) continue;
					if (worms[i] + worms[j] == worms[k]) {
						System.out.println(Integer.toString(k+1)+" "+Integer.toString(j+1)+" "+Integer.toString(i+1));
						return;
					}
				}
			}
		}

		System.out.println("-1");

	}
}
