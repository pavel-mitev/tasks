#include <iostream>
#include <queue>
#include <list>
#include <algorithm>
#include <utility>
using namespace std;

int n,m;
int currMin, currMax;
int bestMin = 0, bestMax = 30000;
void addEdge( list< pair<int,int> > adj[], int u, int v, int w)
{
    adj[u].push_back(make_pair(v,w));
    adj[v].push_back(make_pair(u,w));
}

bool BFS(list< pair<int,int> > adj[])
{
    int count = 1;
    int s = 1;
    bool visited[1001];
    for(int i = 0; i <= n; i++)
        visited[i]=false;

    queue<int> Q;
    visited[s] = true;
    Q.push(s);
    list< pair<int,int> >::iterator i;

    while(!Q.empty())
    {
        s = Q.front();
        Q.pop();

        for(i = adj[s].begin(); i != adj[s].end(); i++)
        {
            int w = i->second;
            if(!visited[i->first] && (currMin <= w) && (currMax >= w))
            {
                visited[i->first] = true;
                Q.push(i->first);
                count++;
            }
        }
    }
    return count == n;
}
int main()
{
    cin >> n >> m;
    list< pair<int,int> > adj[1001];
    int weights[10000];
    for(int i = 0; i < m; i++)
    {
        int u,v,w;
        cin >> u >> v >> w;
        addEdge(adj,u,v,w);

        weights[i] = w;
    }
    sort(weights,weights+m);
    for(int i = 0; i < m; i++)
    {
        currMin = weights[i];
        for(int k = i; k < m; k++)
        {
            currMax = weights[k];
            if((currMax - currMin) < (bestMax - bestMin))
                if(BFS(adj))
                    {
                        bestMax = currMax;
                        bestMin = currMin;
                    }
        }
    }

    cout << bestMin <<" "<< bestMax << endl;
    return 0;
}
