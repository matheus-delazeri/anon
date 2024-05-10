import { getGroup } from "../controllers/group";
import express from "express";

const router = express.Router();

router.get("/:id", getGroup);

export default router;