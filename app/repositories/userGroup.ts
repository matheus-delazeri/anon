import { $Enums, PrismaClient, UserGroup } from "@prisma/client";

export class UserGroupRepository {
    private prisma: PrismaClient;

    constructor(prismaClient: PrismaClient){
        this.prisma = prismaClient;
    }

    async getUsersFromGroup(groupId: number): Promise<UserGroup[] | null>{
        return this.prisma.userGroup.findMany({
            where: {
                group_id: groupId
            }
        });
    }

    async getGroupsOfUser(userId: number): Promise<UserGroup[] | null>{
        return this.prisma.userGroup.findMany({
            where: {
                user_id: userId
            }
        });
    }

    async addUserToGroup(userId: number, groupId: number, role: $Enums.Role): Promise<UserGroup | boolean>{
        return this.prisma.userGroup.create({
            data: {
                user_id: userId,
                group_id: groupId,
                role: role
            }
        });
    }

    async updateRole(userId: number, groupId: number, role: $Enums.Role): Promise<UserGroup | null>{
        return this.prisma.userGroup.update({
            where: {
                user_id_group_id: {
                    user_id: userId, 
                    group_id: groupId
                }
            },
            data: {
                role: role
            }
        });
    }

    async deleteUserFromGroup(userId: number, groupId: number): Promise<UserGroup>{
        return this.prisma.userGroup.delete({
            where: {
                user_id_group_id: {
                    user_id: userId,
                    group_id: groupId
                }
            }
        })
    }
}