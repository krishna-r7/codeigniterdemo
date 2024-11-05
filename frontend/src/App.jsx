import React, { useEffect, useState } from 'react';
import axios from 'axios';

const App = () => {
    const [data, setData] = useState(null);
    const [inputValue, setInputValue] = useState('');
    const [contactValue, setContactValue] = useState(''); 
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    const [users, setUsers] = useState([]); 

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/users'); 
                // Check if response has data
                if (response.data && response.data.data) {
                    setUsers(response.data.data); 
                } else {
                    setUsers([]); // Set users to empty array if no data
                }
            } catch (error) {
                setError(error);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault(); 
        if (!inputValue || !contactValue) { 
            alert('Please enter both username and contact number.');
            return;
        }

        try {
            const response = await axios.post('http://localhost:8000/api/submit', { 
                username: inputValue, 
                contact: contactValue 
            });
            alert('Data submitted successfully!');
            setInputValue('');
            setContactValue(''); 
            
            const fetchUsers = async () => {
                try {
                    const userResponse = await axios.get('http://localhost:8000/api/users');
                    if (userResponse.data && userResponse.data.data) {
                        setUsers(userResponse.data.data); 
                    } else {
                        setUsers([]); // Set users to empty array if no data
                    }
                } catch (error) {
                    setError(error);
                }
            };

            fetchUsers();
        } catch (error) {
            setError(error);
        }
    };

    return (
        <div className='card'>
            <h1>React and CodeIgniter Integration</h1>
            <form onSubmit={handleSubmit}>
                <div>
                    <input
                        type="text"
                        value={inputValue}
                        onChange={(e) => setInputValue(e.target.value)}
                        placeholder="Enter username"
                    />
                </div>
                <div>
                    <input
                        type="text"
                        value={contactValue}
                        onChange={(e) => setContactValue(e.target.value)}
                        placeholder="Enter contact number"
                    />
                </div>
                <button type="submit">Submit</button>
            </form>
            {loading ? (
                <p>Loading...</p>
            ) : error ? (
                <p>Error: {error.message}</p>
            ) : (
                <div>
                    <h2>User List</h2>
                    {users.length > 0 ? (
                        <ul className="list-unstyled">
                            {users.map(user => (
                                <li key={user.id} className="text-decoration-none">{user.username} - {user.contact}</li> 
                            ))}
                        </ul>
                    ) : (
                        <p>No users are registered.</p>
                    )}
                </div>
            )}
        </div>
    );
};

export default App;
