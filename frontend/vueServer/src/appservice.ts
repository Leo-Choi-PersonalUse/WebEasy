export const apiService = () => {
    const url = "http://localhost/backend/api/v1";

    const restfulAPI = async ({ endpoint, method, body }: { endpoint: string, method: string, body?: object }) => {
        try {
            debugger;
            const response = await fetch(`${url}/${endpoint}`, {
                method: method,
                headers: {
                    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbGFyYXZlbC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTcyOTc1NTAwNywiZXhwIjoxNzI5NzU4NjA3LCJuYmYiOjE3Mjk3NTUwMDcsImp0aSI6IkxGSGRtanFHM0NRQ2ZyZmEiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.B5mpwhVQTcYvNJ3FrMFCBCXGVeKyqlsV1xOHdH5A2_M',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(body)
            })
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
            return null;
        }
    };

    //callable function
    return {
        restfulAPI,
    };
};