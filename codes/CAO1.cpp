#include<iostream>
#include<stdio.h>
#define S(n) scanf("%d",&n);

using namespace std;

int CountLeft(char arr[][50],int i,int j)
{
    if( arr[i][j-1] == '^' && arr[i][j-2] == '^')
       return 1;
    return 0;
}

int CountRight(char arr[][50],int i,int j,int c)
{
    if( arr[i][j+1] == '^' && arr[i][j+2] == '^')
       return 1;
    return 0;
}

int CountTop(char arr[][50],int i,int j)
{
     if( arr[i-1][j] == '^' && arr[i-2][j] == '^')
        return 1;
    return 0;
}

int CountBottom(char arr[][50],int i,int j,int r)
{
    if( arr[i+1][j] == '^' && arr[i+2][j] == '^')
        return 1;
    return 0;
}

int main()
{
    int t=0,r=0,c=0,L=0,R=0,T=0,B=0,min=0,count=0;
    char arr[50][50];
    S(t);
    while(t--)
    {
        S(r);
	S(c);
	for(int i=0;i<r;i++)
	{
	    for(int j=0;j<c;j++)
	        S(arr[i][j]);
	}
	if(r<=4 || c<=4)
	{
	    printf("0\n");
	    continue;
	}
	else
	{
            count=0;
	    for(int i=2;i<(r-2);i++)
	    {
	        for(int j=2;j<(c-2);j++)
	        {
		    if(arr[i][j]=='#')
		        continue;
		    L=CountLeft(arr,i,j);
		    R=CountRight(arr,i,j,c);
		    T=CountTop(arr,i,j);
		    B=CountBottom(arr,i,j,r);
		    if(L==1 && R==1 && T==1 && B==1)
		        count++;
		}
	    }
	 }
	printf("%d\n",count);
    }
    return 0;
}
