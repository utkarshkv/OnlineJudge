#include<stdio.h>
#include<math.h>
#include<string.h>
#include<limits.h>
#include<limits>
#include<iostream>
#include<algorithm>
#include<set>
#include<vector>
#include<map>
#define F(i,s,n) for(i=s;i<n;i++)
#define ull unsigned long long
#define ll long long
#define ui unsigned int
#define pb push_back
#define mem(a,p) memset(a,p,sizeof(a))
#define fi first
#define se second
#define mp make_pair

#define s(n) scanf("%d",&n)
#define sc(n) scanf("%c",&n)
#define sl(n) scanf("%lld",&n)
#define sul(n) scanf("%llu",&n)
#define sf(n) scanf("%f",&n)
#define sd(n) scanf("%lf",&n)
#define ss(n) scanf("%s",n)

#define INF (int)1e9
#define EPS 1e-9

#define bitcount __builtin_popcount
#define gcd __gcd

#define forit(v,c) for(typeof((c).begin()) v=(c).begin();v!=(c).end();++v)
#define all(a) a.begin(),a.end()
#define in(a,b) ((b).find(a)!=(b).end())
#define sz(a) ((int)(a.size()))
#define checkbit(n,b) ((n>>b)&1)
#define DREP(a) sort(all(a));a.erase(unique(all(a)),a.end())
#define INDEX(arr,ind) (lower_bound(all(arr),ind)-arr.begin())

#define VI vector<int>
#define VVI vector<vector<int> >
#define VPI vector<pair<int,int> >
#define MOD 1000000007

#ifndef ONLINE_JUDGE
#define gc getchar
#else
#define gc getchar_unlocked
#endif

#ifndef ONLINE_JUDGE
#define pc putchar
#else
#define pc putchar_unlocked
#endif


using namespace std;

vector<int> a;
int b[60][60];

inline int inp()
{
    int n=0;
    char c;
    while(c<'0' || c>'9')
        c=gc();
    while(c>='0' && c<='9')
    {
        n=n*10+c-48;
        c=gc();
    }
    return n;
}

inline void putn(int n)
{
    if(!n) pc('0');
    char pb[10];
    int pi = 0;
    while(n)
        pb[pi++]=(n%10)+'0',n/=10;
    while(pi)
        pc(pb[--pi]);
}


int main()
{
    int q,t,i,n,k,mn,j,cnt;
    n=inp();
    F(i,0,n)
    {
        t=inp();
        a.push_back(t);
    }
    F(i,0,n)
        F(j,0,n)
            b[i][j]=0;
    F(i,0,n)
    {
        mn=INT_MAX;
        F(j,i,n)
        {
            t=a[j];
            mn=min(mn,t);
            b[i][j]=mn;
        }
    }
    q=inp();
    while(q--)
    {
        cnt=0;
        k=inp();
        F(i,0,n)
            cnt+=count(b[i],b[i]+n,k);
        printf("%d\n",cnt);
    }
    return 0;
}
