#include <cstdio>
#include <iostream>
#include <algorithm>
#include <set>
#include <map>
#include <stack>
#include <list>
#include <queue>
#include <deque>
#include <cctype>
#include <string>
#include <vector>
#include <sstream>
#include <iterator>
#include <cmath>
using namespace std;

typedef vector <int > VI;
typedef vector < VI > VVI;
typedef long long LL;
typedef vector < LL > VLL;
typedef vector < double > VD;
typedef vector < string > VS;
typedef pair<int,int> PII;
typedef vector <PII> VPII;
typedef istringstream ISS;

#define ALL(x) x.begin(),x.end()
#define REP(i,n) for (int i=0; i<n; ++i)
#define FOR(var,pocz,koniec) for (int var=pocz; var<=koniec; ++var)
#define FORD(var,pocz,koniec) for (int var=pocz; var>=koniec; --var)
#define FOREACH(it, X) for(__typeof(X.begin()) it = X.begin(); it != X.end(); ++it)
#define PB push_back
#define PF push_front
#define MP(a,b) make_pair(a,b)
#define ST first
#define ND second
#define SIZE(x) (int)x.size()

const int N=110;
string nazwy[N];
int ceny[N];
int used[N];
int t[N];

int licz(int n){
  const int INF=1000000010;
  FOR(i,0,n) t[i]=INF;
  t[0]=-1;
  REP(i,n) if (!used[i]){
    int x=upper_bound(t,t+n+1,ceny[i])-t;
    t[x]=min(t[x],ceny[i]);
  }
  int res=0;
  while (res+1<n && t[res+1]<INF) res++;
  return res;
}

int main(){
  int testy;
  cin >> testy;
  REP(foo,testy){
    printf("Case #%d:",foo+1);
    string s;
    int n=0;
    while (1){
      cin >> s;
      if (!isdigit(s[0])) nazwy[n++]=s;
      else break;
    }
    ceny[0]=atoi(s.c_str());
    FOR(i,1,n-1) cin >> ceny[i];

    REP(i,n) used[i]=0;
    int wynik=licz(n);
    vector<pair<string,int> > v;
    REP(i,n) v.PB(MP(nazwy[i],i)),used[i]=0;
//    printf("wynik=%d\n",wynik);

    sort(ALL(v));
    FOREACH(it,v){
      used[it->ND]=1;
      if (licz(n)==wynik) printf(" %s",it->ST.c_str());
      else used[it->ND]=0;
    }
    puts("");
  }
  return 0;
}
