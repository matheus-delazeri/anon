import { getRole, getGroupsOfUser, getUsersFromGroup, addUserToGroup, updateRole, deleteUserFromGroup } from "../controllers/userGroup";
import express from "express";

const router = express.Router();

//Get
router.get("/role/:userId/:groupId", getRole);
router.get("/groups/:userId", getGroupsOfUser);
router.get("/users/:groupId", getUsersFromGroup);

//Post
router.post("/add/", addUserToGroup);

//Put
router.put("/update/", updateRole);

//Delete
router.delete("/delete/", deleteUserFromGroup)

export default router;