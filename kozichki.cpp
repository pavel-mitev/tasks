#include <iostream>
#include <algorithm>
using namespace std;

bool canBeTransported(int* arr, int N, int K, int capacity)
{
	bool* transp = new bool[N];
	int transported=0;
	int trips = 0;
	for(int i = 0; i < N; i++)
		{
			transp[i] = false;
		}
	while(trips != K)
	{
		int currentWeight = 0;
		for(int i = N-1; i >= 0; i--)
		{
			if(transp[i] == 0)
				{
					if((capacity - currentWeight) >= arr[i])
					{
						transp[i] = true;
						currentWeight+=arr[i];
						transported++;
					}
				}
		}
		trips++;
	}
	delete[] transp;
	if(transported == N && trips == K)
			return true;
	return false;
}
int main()
{
	int N,K;
	cin >> N;
	cin >> K;
	int* arr = new int[N];
	for(int i = 0; i < N; i++)
	{
		cin >> arr[i];
	}
	sort(arr,arr+N);
	int boatCapacity=arr[N-1];
	while(!canBeTransported(arr,N,K,boatCapacity))
		boatCapacity++;
	cout << boatCapacity << endl;
	delete[] arr;
	return 0;
}
