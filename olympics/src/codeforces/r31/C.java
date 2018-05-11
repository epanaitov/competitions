

import java.io.*;
import java.util.Arrays;
/**
 *
 * @author eugene
 */


public class C {

	static class Segment {
		public int start = 0;
		public int end = 0;
	}

	private static boolean inside(int p, Segment s) {
		return (p > s.start) && (p < s.end);
	}

	private static boolean intersects(Segment a, Segment b) {
		if (inside(a.start, b) || inside(a.end, b) || inside(b.start, a) || inside(b.end, a) || ((a.start == b.start) && (a.end == b.end))) return true;
		return false;
	}

	public static void main(String[] args) {
		BufferedReader in = new BufferedReader(new InputStreamReader(System.in));
		Integer n = 0;

		int groups[][] = new int[5000][2];
		boolean[][] M = new boolean[5000][5000];
		int[] P = new int[5000];

		int i = 0;
		int j = 0;
		int intersections = 0;

		//System.out.println("reading...");
		//Date stamp1 = new Date();

		try {
			n = Integer.parseInt(in.readLine().trim());

			for (i=0; i<n; i++) {
				P[i] = 0;
				for (j=0; j < n; j++) M[i][j] = false;
			}

			for (i=0; i<n; i++) {
				String[] tmp = in.readLine().split(" ");
				groups[i][0] = Integer.parseInt(tmp[0]);
				groups[i][1] = Integer.parseInt(tmp[1]);
			}

		} catch (Exception e) {
			System.out.println(e.getStackTrace());
		}

		int i_max = 0;

		for (i=0; i<n; i++) {
			for (j=0; j<i; j++) {

				int[] a = groups[i];
				int[] b = groups[j];

				if (
						((a[0] > b[0]) && (a[0] < b[1])) ||
						((a[1] > b[0]) && (a[1] < b[1])) ||
						((b[0] > a[0]) && (b[0] < a[1])) ||
						((b[1] > a[0]) && (b[1] < a[1])) ||
						((a[0] == b[0]) && (a[1] == b[1]))
					) {
					M[i][j] = true;
					//M[j][i] = true;
					P[i]++;
					P[j]++;
					if (P[i] > i_max) i_max = P[i];
					if (P[j] > i_max) i_max = P[j];
					intersections++;
				}
			}
		}
		
		//Date stamp3 = new Date();
		//System.out.println("matrix done in "+Double.toString((stamp3.getTime() - stamp2.getTime())/1000)+" secs");
		

		if (intersections == 0) {
			// first sample
			System.out.println(n);
			for (i=1; i<=n; i++) System.out.format("%d ", i);
			return;
		}

		int[] solutions = new int[n];
		int solution_count = 0;

		//System.out.println("Counting solutions");
		for (i=0; i<n; i++) {
			if (P[i] < i_max) continue;

			boolean solution = true;

			// otherwise this one intersects with other segments
			for (j=0; j<n; j++) {
				if (j == i) continue;
				for (int k=0; k<j; k++) {
					if (k == i) continue;
					if (M[j][k]) {
						// two other segements intersect
						// i is not a solutuion
						solution = false;
						break;
					}
				}
				if (!solution) break;
			}

			if (solution) {
				solutions[solution_count] = i;
				solution_count++;
			}
		}

		if (solution_count > 0) {
			Arrays.sort(solutions, 0, solution_count-1);
			System.out.println(solution_count);
			for (i=0; i<solution_count; i++) System.out.format("%d ", solutions[i]+1);
		} else {
			System.out.println("0");
		}
		
	}
}
