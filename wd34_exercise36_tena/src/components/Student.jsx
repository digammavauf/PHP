import React from 'react';
import { useState, useEffect } from "react";
import axios from 'axios';

const Student = () => {
    const _CREATE = 1;
    const _READ = 2;
    const _UPDATE = 3;
    const _DELETE = 4;
    const [student_firstName, setStudent_firstName] = useState("");
    const [student_lastName, setStudent_lastName] = useState("");
    const [student_batch, setStudent_batch] = useState(0);
    const [students, setStudents] = useState([]);
    const addStudent = (e) => {
        e.preventDefault();
        let getData = new FormData();
        getData.append('student_firstname', student_firstName);
        getData.append('student_lastname', student_lastName);
        getData.append('student_batch', student_batch);
        getData.append('mode', _CREATE);
        axios({
            method: 'POST',
            url: 'http://localhost/wd34-php/WD34_Exercise36_Tena_Db.php',
            data: getData
        }).then((response) => {
            alert(response.data);
        });
    }
    const updateStudent = (e) => {
        e.preventDefault();
        let getData = new FormData();
        getData.append('student_id', e.currentTarget.title);
        getData.append('student_firstname', document.getElementById('student_firstname_' + e.currentTarget.title).value);
        getData.append('student_lastname', document.getElementById('student_lastname_' + e.currentTarget.title).value);
        getData.append('student_batch', document.getElementById('student_batch_' + e.currentTarget.title).value);
        getData.append('mode', _UPDATE);
        axios({
            method: 'POST',
            url: 'http://localhost/wd34-php/WD34_Exercise36_Tena_Db.php',
            data: getData
        }).then((response) => {
            alert(response.data);
        });
    }
    const removeStudent = (e) => {
        e.preventDefault();
        let getData = new FormData();
        getData.append('student_id', e.currentTarget.title);
        getData.append('mode', _DELETE);
        axios({
            method: 'POST',
            url: 'http://localhost/wd34-php/WD34_Exercise36_Tena_Db.php',
            data: getData
        }).then((response) => {
            alert(response.data);
        });
    }
    useEffect(()=>{
        const url = "http://localhost/wd34-php/WD34_Exercise36_Tena_Db.php";
        axios.get(url).then((response) => {
            setStudents(response.data);
            console.log(students);
        });
    });

    return (
        <div>
            <div className="row gap-2">
                <div className="col-6 input-group">
                    <div className="input-group-prepend">
                        <label className="input-group-text" htmlFor="student_firstname">First Name</label>
                    </div>
                    <input type="text" name="student_firstname" id="student_firstname" onChange={(e)=>setStudent_firstName(e.target.value)} />                
                </div>

                <div className="col-6 input-group">
                    <div className="input-group-prepend">
                        <label className="input-group-text" htmlFor="student_lastname">Last Name</label>
                    </div>
                    <input type="text" name="student_lastname" id="student_lastname" onChange={(e)=>setStudent_lastName(e.target.value)} />
                </div>

                <div className="col-6 input-group">
                    <div className="input-group-prepend">
                        <label className="input-group-text" htmlFor="student_batch">Batch</label>
                    </div>
                    <input type="number" name="student_batch" id="student_batch" onChange={(e)=>setStudent_batch(e.target.value)} />
                </div>

                <div className="col-6 input-group">
                    <button className="btn btn-success" type="submit" name="mode" value={_CREATE} onClick={addStudent}>Add</button>
                </div>
                
                <ul>
                    {
                        students.map((val) => {
                            return (
                                <li key={val.student_id} className="d-flex gap-2 mb-2">
                                    <input type="text" className="form-control" name={"student_firstname_" + val.student_id} id={"student_firstname_" + val.student_id} value={val.student_firstname} onChange={(e)=>setStudent_firstName(e.target.value)} />
                                    <input type="text" className="form-control" name={"student_lastname_" + val.student_id} id={"student_lastname_" + val.student_id} value={val.student_lastname} onChange={(e)=>setStudent_lastName(e.target.value)} />
                                    <input type="text" className="form-control" name={"student_batch_" + val.student_id} id={"student_batch_" + val.student_id} value={val.student_batch} onChange={(e)=>setStudent_batch(e.target.value)} />
                                    <button className="btn btn-warning btn-sm mr-2" type="submit" name="mode" value={_UPDATE} title={val.student_id} onClick={updateStudent}>Update</button>
                                    <button className="btn btn-danger btn-sm " type="submit" name="mode" value={_DELETE} title={val.student_id} onClick={removeStudent}>Remove</button>
                                </li>
                            )
                        })
                    }
                </ul>
            </div>
        </div>
    );
}
 
export default Student;