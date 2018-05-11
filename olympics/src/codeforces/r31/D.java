

import java.io.*;
import java.util.Arrays;

/**
 *
 * @author eugene
 */
public class D {

	static class Slice {
		public boolean up = false;
		public boolean down = false;
		public boolean left = false;
		public boolean right = false;
		public boolean counted = false;
	}

	public static void main(String[] args) {

		BufferedReader in = new BufferedReader(new InputStreamReader(System.in));

		int W = 0;
		int H = 0;
		int n = 0;
		Slice[][] choco = new Slice[100][100];
		
		try {
			String[] tmp = in.readLine().split(" ");
			W = Integer.parseInt(tmp[0].trim());
			H = Integer.parseInt(tmp[1].trim());
			n = Integer.parseInt(tmp[2].trim());

			for (int w=0; w < W; w++) {
				for (int h=0; h < H; h++) {
					choco[h][w] = new Slice();
					choco[h][w].up = true;
					choco[h][w].down = true;
					choco[h][w].left = true;
					choco[h][w].right = true;
					if (h == 0) choco[h][w].down = false;
					if (h == H-1) choco[h][w].up = false;
					if (w == 0) choco[h][w].left = false;
					if (w == W-1) choco[h][w].right = false;
				}
			}

			for (int i = 0; i < n; i++) {
				tmp = in.readLine().split(" ");
				int x1 = Integer.parseInt(tmp[0].trim());
				int y1 = Integer.parseInt(tmp[1].trim());
				int x2 = Integer.parseInt(tmp[2].trim());
				int y2 = Integer.parseInt(tmp[3].trim());

				int x = 0;
				int y = 0;
				if ((x1 == x2) && (x1 > 0) && (x1 < W)) {
					// vertical
					for (y=Math.min(y1, y2); y< Math.max(y1, y2); y++) {
						choco[y][x1].left = false;
						choco[y][x1-1].right = false;
					}
				}
				if ((y1 == y2) && (y1 > 0) && (y1 < H)) {
					//horizontal
					for (x = Math.min(x1, x2); x < Math.max(x1, x2); x++) {
						choco[y1][x].down = false;
						choco[y1-1][x].up = false;
					}
				}
			}
		} catch (Exception e) {
			System.out.println(e);
		}

		int[] areas = new int[100];
		int slices = 0;
		for (int h = 0; h < H; h++) {
			for (int w = 0; w < W; w++) {
				if (choco[h][w].counted) continue;

				// well ok, let's go breadth that time

				int x = w;
				int y = h;

				int[][] way = new int[1000][2]; // let it be the queue now
				int d = 0;
				int q = 0;
				way[d][0] = x;
				way[d][1] = y;
				choco[y][x].counted = true;
				areas[slices]++;

				do {
					y = way[q][1];
					x = way[q][0];
					

					if (choco[y][x].up && !choco[y+1][x].counted) {
						d++;
						way[d][1] = y+1;
						way[d][0] = x;
						choco[y+1][x].counted = true;
						areas[slices]++;
					}

					if (choco[y][x].down && !choco[y-1][x].counted) {
						d++;
						way[d][1] = y-1;
						way[d][0] = x;
						choco[y-1][x].counted = true;
						areas[slices]++;
					}

					if (choco[y][x].left && !choco[y][x-1].counted) {
						d++;
						way[d][1] = y;
						way[d][0] = x-1;
						choco[y][x-1].counted = true;
						areas[slices]++;
					}

					if (choco[y][x].right && !choco[y][x+1].counted) {
						d++;
						way[d][1] = y;
						way[d][0] = x+1;
						choco[y][x+1].counted = true;
						areas[slices]++;
					}
					
					if (d == q) break;
					else q++;
				} while (true);
				
				slices++;
			}
		}

		Arrays.sort(areas, 0, n+1);

		for (int i = 0; i <= n; i++) System.out.format("%d ", areas[i]);

	}
}
