export const apiService = () => {
    const url = "http://localhost/backend/api/v1";

    const restfulAPI = async ({ endpoint, method, body }: { endpoint: string, method: string, body?: object }) => {
        try {
            //debugger;
            const response = await fetch(`${url}/${endpoint}`, {
                method: method,
                headers: {
                    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbGFyYXZlbC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTczMDA4MjM5NCwiZXhwIjoxNzMwMDg1OTk0LCJuYmYiOjE3MzAwODIzOTQsImp0aSI6IlRxUjFWOHVXbXNzZHlJaFgiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.yNOQqsclwNl0TC1e82hIWFbMr-Ybo8R4vP4Gm21Pz4k',
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