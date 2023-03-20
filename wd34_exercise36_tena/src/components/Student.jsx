import React from 'react';
import { useState, useEffect } from "react";
import axios from 'axios';

const Student = () => {
    const [student_firstName, setStudent_firstName] = useState("");
    const [student_lastName, setStudent_lastName] = useState("");
    const [student_batch, setStudent_batch] = useState(0);
    const [students, setStudents] = useState([]);
    
    useEffect(()=>{
        const url = "http://localhost/wd34-php/WD34_Exercise36_Tena_Db.php";
        let i = 0;
        axios.get(url).then((response)=>{
            setStudents(response.data);
            //console.log(students);
        });
    });

    return (
        <div>
            <div className="input-group">
                <div className="input-group-prepend">
                    <label className="input-group-text" htmlFor="student_firstname">First Name</label>
                </div>
                <input type="text" name="student_firstname" id="student_firstname" onChange={(e)=>setStudent_firstName(e.target.value)} />                
            </div>

            <div className="input-group">
                <div className="input-group-prepend">
                    <label className="input-group-text" htmlFor="student_lastname">Last Name</label>
                </div>
                <input type="text" name="student_lastname" id="student_lastname" onChange={(e)=>setStudent_lastName(e.target.value)} />
            </div>

            <div className="input-group">
                <div className="input-group-prepend">
                    <label className="input-group-text" htmlFor="student_batch">Batch</label>
                </div>
                <input type="number" name="student_batch" id="student_batch" onChange={(e)=>setStudent_batch(e.target.value)} />
            </div>
            
            <button type="submit">Add</button>

            <ul>
                {
                    students.map((val) => {
                        return (
                            <li>
                                {val.student_firstname}
                            </li>
                        )
                    })
                }
            </ul>
        </div>
    );
}
 
export default Student;